forcast_meta = [];
forcast_meta.push({name: "period", label: "Period", datatype: "string", 'editable': false});
forcast_meta.push({name: "total", label: "Total", datatype: "double", 'editable': false});
data = [];
data.push({id: 1, values: {'period': 'FORECAST', 'total': 0}});
data.push({id: 2, values: {'period': 'ACTUAL', 'total': 0}});
data.push({id: 3, values: {'period': 'DIFFERENCE', 'total': 0}});
data.push({id: 4, values: {'period': 'PLAN COST', 'total': 0}});
forcast_data = data;
$(document).ready(function () {
    $('#saveForeCast').prop('disabled', 'disabled');

    $.ajaxSetup({async: false});
    var projectId = 0;
    $('#adjustforecast').on('click', function () {
        var projectId = $('#projectId').val();
        if (projectId != '' && projectId != 0 && projectId != undefined) {
            $('#saveForeCast').prop('disabled', false);
            $.ajax({
                url: "/admin/costforcast/project/" + projectId + "/adjust",
                method: "POST",
                dataType: "JSON",
                data: {'_token': token},
                success: function (result) {
                    renderForecastGrid(result);
                }
            });
        } else {
            $('#prjerror').html('<p class="text-danger">Please select project</p>');
        }
    });

    $('#saveForeCast').on('click', function () {
        var count = 0;
        var data = {};
        $.each(forcast_data[0].values, function (key, val) {
            if (count > 0) {
                data[key.replace('months-', '')] = val;
            }
            count++;
        });
        update_forcast(data);
    });

    $.ajaxSetup({async: false});
    $('#projectId').on('change', function () {
        $('#saveForeCast').prop('disabled', 'disabled');
        $('#project_start_date').prop('readonly', false);
        $('#project_end_date').prop('readonly', false);
        var project_id = $(this).val();
        $('#prjerror').html('');
        $.ajax({
            url: "/admin/projectdata/" + project_id,
            method: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#project_description').val(data.project_desc);
                $('#project_start_date').val(data.start_date.split(' ')[0]);
                $('#project_end_date').val(data.end_date.split(' ')[0]);
                $.ajax({
                    url: "/admin/costforcast/project/" + project_id,
                    method: "POST",
                    data: {'_token': token},
                    dataType: "JSON",
                    success: function (result) {
                        renderForecastGrid(result);
                    }
                });
            }
        });
    });
//start of doc ready

    function renderForecastGrid(result) {
        var total = 0;
        var values = {};
        var months = 0;
        values['period'] = 'FORECAST';
        var count = 1;
        for (x in result.cost_forecast.values.forecast)
        {
            if (x !== 'Total' && x !== 'total') {
                total += parseInt(result.cost_forecast.values.forecast[x]);
            }
            values[ 'months-' + x.toLowerCase()] = result.cost_forecast.values.forecast[x];
            months++;
            count++;
        }

        values['total'] = total;
        data = [];
        data.push({id: 1, 'values': values});

        var total = 0;
        var values = {};
        var months = 0;
        values['period'] = 'ACTUAL';
        for (x in result.cost_forecast.values.actual)
        {
            if (result.cost_forecast.values.actual[x] != null && result.cost_forecast.values.actual[x] != 'null' && result.cost_forecast.values.actual[x] != undefined)
                total += parseInt(result.cost_forecast.values.actual[x]);
            values[ 'months-' + x.toLowerCase()] = result.cost_forecast.values.actual[x];
            months++;
        }
        values['total'] = total;
        data.push({id: 2, 'values': values});

        var total = 0;
        var values = {};
        var months = 0;
        values['period'] = 'DIFFERENCE';
        for (x in result.cost_forecast.values.difference)
        {
            total += parseInt(result.cost_forecast.values.difference[x]);
            values[ 'months-' + x.toLowerCase()] = result.cost_forecast.values.difference[x];
            months++;
        }
        values['total'] = total;
        data.push({id: 3, 'values': values});
        var plancost = result.cost_forecast.values.plancost;
        var avg = plancost / parseInt(months);
        values = {};
        values['period'] = 'PLAN COST';
        for (x in result.cost_forecast.values.forcastYear)
        {
            total += parseInt(result.cost_forecast.values.forcastYear[x]);
            values[ 'months-' + x.toLowerCase()] = (plancost / parseInt(result.cost_forecast.values.period.length));
        }

        values['total'] = plancost;
        data.push({id: 4, 'values': values});
        forcast_data = data;
        $('[name=project_end_date]').trigger('dp.change');
    }
});
(function () {
    /*--------------------------------------------------------------------------------------*/
    costForcast = new EditableGrid("costForcast", {
        enableSort: false,
        // called when some value has been modified: we display a message
        modelChanged: function (rowIdx, colIdx, oldValue, newValue, row) {
            if (rowIdx == 0) {

                // add the column forcast to generate the total forecast cost
                var sum_of_months = 0;
                var element = row.querySelectorAll('td');
                var dataObj = {};
                $(element).each(function (i, ele) {

                    if (ele.className.indexOf('-months-') != -1)
                    {
                        if (ele.innerText != '')
                        {
                            dataObj[ele.className.split('-')[2].replace(' nan', '')] = parseInt(ele.innerText);
                            sum_of_months = sum_of_months + parseInt(ele.innerText);
                        }
                    }
                });
                if (isNaN(sum_of_months))
                    sum_of_months = 0;
                row.querySelector('.editablegrid-total').innerText = sum_of_months.toFixed(2);
                costForcast.data[rowIdx].columns[costForcast.data[rowIdx].columns.length - 2] = sum_of_months.toFixed(2);

                if (row.id == "costForcast_1") {
                    update_forcast(dataObj);
                }
            }
        }

    });
    costForcast.setActions = function () {
        this.renderGrid("grid_cost", "testgrid");
    };
    costForcast.editCell = function (rowIndex, columnIndex)
    {
        if (rowIndex < this.getRowCount() - 3)
            var target = this.getCell(rowIndex, columnIndex);
        with (this) {

            var column = columns[columnIndex];
            if (column) {

                // if another row has been selected: callback
                if (rowIndex > -1) {
                    rowSelected(lastSelectedRowIndex, rowIndex);
                    lastSelectedRowIndex = rowIndex;
                }

                // edit current cell value
                if (!column.editable) {
                    readonlyWarning(column);
                } else {
                    if (rowIndex < 0) {
                        if (column.headerEditor && isHeaderEditable(rowIndex, columnIndex))
                            column.headerEditor.edit(rowIndex, columnIndex, target, column.label);
                    } else if (column.cellEditor && isEditable(rowIndex, columnIndex))
                        column.cellEditor.edit(rowIndex, columnIndex, target, getValueAt(rowIndex, columnIndex));
                }
            }
        }
    };
    costForcast.load({"metadata": forcast_meta, "data": forcast_data});
    costForcast.renderGrid("grid_cost", "testgrid");
    costForcast.setActions();
    $('[name=project_start_date],[name=project_end_date]').on('dp.change', function () {
        getDateCols();
    });

})()//end of doc ready

function getDateCols() {

    from = $('[name=project_start_date]').val();
    to = $('[name=project_end_date]').val();
    if (to != '' && from != '')
    {
        fromM = moment(from);
        toM = moment(to);
        if (fromM.year() < toM.year() || fromM.year() == toM.year()) {
            _$("message").innerHTML = "";
            var diff = toM.diff(fromM, 'months', true);
            meta = [];
            meta.push({name: "period", label: "Period", datatype: "string", 'editable': false});
            toM.format("MMM").toLowerCase();
            if (parseInt(fromM.format('M')) <= parseInt(toM.format('M'))) {
                for (i = parseInt(fromM.format('M')); i <= parseInt(toM.format('M')); i++) {

                    if (fromM.year() == toM.year())
                    {
                        var current = moment();
                        var m = moment([parseInt(fromM.year()), i - 1]).format('MMM_YYYY');
                        var temp = moment([parseInt(fromM.year()), i - 1]);
                        if (current.diff(temp, 'months') <= 0)
                        {
                            meta.push({name: 'months-' + m.toLowerCase(), label: m, datatype: "double", 'editable': true});
                        } else {
                            meta.push({name: 'months-' + m.toLowerCase(), label: m, datatype: "double", 'editable': true});
                        }

                    } else {
                        var fromMonth = parseInt(fromM.format('M'));
                        for (year = parseInt(fromM.year()); year <= parseInt(toM.year()); year++) {
                            for (i = fromMonth; i <= 12; i++) {
                                if (year == parseInt(toM.year()) && i > parseInt(toM.format('M'))) {
                                    break;
                                }
                                var m = moment([parseInt(year), i - 1]).format('MMM_YYYY');
                                var name = 'months-' + m.toLowerCase();
                                meta.push({name: name, label: m, datatype: "integer", 'editable': true, values: 0});
                            }
                            fromMonth = parseInt(1);
                        }
                    }
                }
            } else {
                for (i = parseInt(fromM.format('M')); i <= 12; i++) {


                    if (fromM.year() <= toM.year())
                    {
                        var current = moment();
                        var m = moment([parseInt(fromM.year()), i - 1]).format('MMM_YYYY');
                        var temp = moment([parseInt(fromM.year()), i - 1]);
                        if (current.diff(temp, 'months') <= 0)
                        {
                            meta.push({name: 'months-' + m.toLowerCase(), label: m, datatype: "double", 'editable': true});
                        } else {
                            meta.push({name: 'months-' + m.toLowerCase(), label: m, datatype: "double", 'editable': true});
                        }
                    }
                }
                if (parseInt(fromM.format('M')) >= parseInt(toM.format('M'))) {
                    var toMonth = parseInt(toM.format('M'));
                    for (j = 1; j <= parseInt(toM.format('M')); j++) {
                        var current = moment();
                        var m = moment([parseInt(toM.year()), j - 1]).format('MMM_YYYY');
                        var temp = moment([parseInt(toM.year()), j - 1]);
                        meta.push({name: 'months-' + m.toLowerCase(), label: m, datatype: "double", 'editable': true});
                    }
                }

            }
            meta.push({name: "total", label: "Total", datatype: "double", 'editable': false});
            costForcast.load({"metadata": meta, "data": forcast_data});
            costForcast.setActions();
        } else
        {
            _$("message").innerHTML = "<p id='errorMessage' class='alert alert-danger'> Project end date can't be before the project start date </p>";
            $('#errorMessage').show(0).delay(2000).hide(2000);
        }
    }
}//end of function
