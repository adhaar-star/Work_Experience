forcast_meta = [];
forcast_meta.push({name: "period", label: "Period", datatype: "string", 'editable': false});
forcast_meta.push({name: "total", label: "Total", datatype: "double", 'editable': false});
//forcast_meta.push({name: "action", label: "Action", datatype: "html", 'editable': false});
data = [];
data.push({id: 1, values: {'period': 'FORECAST DEMAND', 'total': 0}});
data.push({id: 2, values: {'period': 'ACTUAL HRS', 'total': 0}});
data.push({id: 3, values: {'period': 'DIFFERENCE', 'total': 0}});
//data.push({id: 4, values: {'period': 'PLAN COST', 'total': 0}});
forcast_data = data;
$(document).ready(function () {
    $('#saveForeCast').prop('disabled','disabled');
    $.ajaxSetup({async: false});
    var projectId = 0;
    $('#adjustforecast').on('click', function () {
        var projectId = $('#projectId').val();
        if (projectId != '' && projectId != 0 && projectId != undefined) {
            $('#saveForeCast').prop('disabled', false);
           $.ajax({
                url: "/admin/demandforecast/project/" + projectId + "/adjust",
                method: "POST",
                dataType: "JSON",
                data: {'_token': token},
                success: function (result) {
                    renderForecastGrid(result);
                }
            });
        } else {
            $('#prjerror').html('<p class="perror" style="color:red;">Please Select Project Id</p>');
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
        update_demandforcast(data);
    });

    $.ajaxSetup({async: false});
    $('#projectId').on('change', function () {
        $('#prjerror').html('');
        var project_id = $(this).val();
        $.ajax({
            url: "/admin/demandforecast/projectdata/" + project_id,
            method: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#project_description').val(data.project_desc);
                $('#project_start_date').val(data.start_date.split(' ')[0]);
                $('#project_end_date').val(data.end_date.split(' ')[0]);
                $.ajax({
                    url: "/admin/demandforecast/project/" + project_id,
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
        values['period'] = 'FORECAST DEMAND';
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
        values['period'] = 'ACTUAL HRS';
        for (x in result.cost_forecast.values.actual)
        {
            if (result.cost_forecast.values.actual[x] != null && result.cost_forecast.values.actual[x] != 'null' && result.cost_forecast.values.actual[x] != undefined)
                total += parseInt(result.cost_forecast.values.actual[x]);
            values[ 'months-' + x.toLowerCase()] = parseInt(result.cost_forecast.values.actual[x]);
            months++;
        }
        values['total'] = total;
        data.push({id: 2, 'values': values});
        //data.push({id: 2, 'values': {'period': 'ACTUAL', 'total': 0}});

        var total = 0;
        var values = {};
        var months = 0;
        values['period'] = 'DIFFERENCE';
        for (x in result.cost_forecast.values.difference)
        {
//        console.log(result.cost_forecast.values.difference[x]);
            total += parseInt(result.cost_forecast.values.difference[x]);
            values[ 'months-' + x.toLowerCase()] = result.cost_forecast.values.difference[x];
            months++;
        }
        values['total'] = total;
        data.push({id: 3, 'values': values});
        //data.push({id: 3, 'values': {'period': 'DIFFERENCE', 'total': 0}});

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
                var hours = 0;
                var minutes = 0;
                var seconds = 0;
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
                //

                if (row.id == "costForcast_1") {
//                    console.log('dataObj', dataObj);
                    console.log('dataObj', dataObj);
                    update_demandforcast(dataObj);
                }
//                
            }
        }

    });
    costForcast.setActions = function () {
        this.renderGrid("grid_cost", "testgrid");
        $('.testgrid').find('thead').find('.editablegrid-months-jan_2017').html('Jan 2017 (Hrs)');
        $('.testgrid').find('thead').find('.editablegrid-months-feb_2017').html('Feb 2017 (Hrs)');
        $('.testgrid').find('thead').find('.editablegrid-months-mar_2017').html('Mar 2017 (Hrs)');
        $('.testgrid').find('thead').find('.editablegrid-months-apr_2017').html('Apr 2017 (Hrs)');
        $('.testgrid').find('thead').find('.editablegrid-months-may_2017').html('May 2017 (Hrs)');
        $('.testgrid').find('thead').find('.editablegrid-months-jun_2017').html('Jun 2017 (Hrs)');
        $('.testgrid').find('thead').find('.editablegrid-months-jul_2017').html('Jul 2017 (Hrs)');
        $('.testgrid').find('thead').find('.editablegrid-months-aug_2017').html('Aug 2017 (Hrs)');
        $('.testgrid').find('thead').find('.editablegrid-months-sep_2017').html('Sep 2017 (Hrs)');
        $('.testgrid').find('thead').find('.editablegrid-months-oct_2017').html('Oct 2017 (Hrs)');
        $('.testgrid').find('thead').find('.editablegrid-months-nov_2017').html('Nov 2017 (Hrs)');
        $('.testgrid').find('thead').find('.editablegrid-months-dec_2017').html('Dec 2017 (Hrs)');
        $('#costForcast_4').hide();
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
    // month column auto load code 
    // get min month and max month then render with data

//    var min_date = max_date = moment();
//    $(result).each(function (i, data) {
//        Object.keys(data.values).filter(function (key) {
//            var min;
//            if (key.indexOf('hours-') != -1)//change as per you data
//            {
//                console.log(key.split('-')[1]);
//                var m = moment(key.split('-')[1], 'MMM_YYYY');
//                if (m.isBefore(min_date))
//                {
//                    min_date = m;
//                } else if (m.isAfter(max_date))
//                {
//                    max_date = m;
//                }
//            }
//        })
//    });
//    $('[name=from_date]').val(min_date.format('YYYY-MM-DD'));
//    $('[name=to_date]').val(max_date.format('YYYY-MM-DD'));
//    $('[name=to_date]').trigger('dp-change');
})()//end of doc ready



function getDateCols() {

    from = $('[name=project_start_date]').val();
    to = $('[name=project_end_date]').val();
    if (to != '' && from != '')
    {
        fromM = moment(from);
        toM = moment(to);
        if (fromM.month() < toM.month() || fromM.month() == toM.month()) {
            _$("message").innerHTML = "";
            var diff = toM.diff(fromM, 'months', true);
            meta = [];
            meta.push({name: "period", label: "Period", datatype: "string", 'editable': false});
            toM.format("MMM").toLowerCase();
            for (i = parseInt(fromM.format('M')); i <= parseInt(toM.format('M')); i++) {


                if (fromM.year() == toM.year())
                {
                    var current = moment();
                    var m = moment([parseInt(fromM.year()), i - 1]).format('MMM_YYYY');
                    var temp = moment([parseInt(fromM.year()), i - 1]);
//                    console.log(current.diff(temp, 'months'));
                    if (current.diff(temp, 'months') <= 0)
                    {
                        meta.push({name: 'months-' + m.toLowerCase(), label: m + "  (Hrs)", datatype: "double", 'editable': true});
                    } else {
                        meta.push({name: 'months-' + m.toLowerCase(), label: m + "  (Hrs)", datatype: "double", 'editable': true});
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
                            meta.push({name: name, label: m + "  (Hrs)", datatype: "integer", 'editable': true, values: 0});
                        }
                        fromMonth = parseInt(1);
                    }
                }
            }

            meta.push({name: "total", label: "Total", datatype: "string", 'editable': false});
//            meta.push({name: "action", label: "Action", datatype: "html", 'editable': false});
            costForcast.load({"metadata": meta, "data": forcast_data});
            costForcast.setActions();
        } else
        {
            _$("message").innerHTML = "<p class='err'> 'To Date' can't be before the 'From Date' </p>";
        }
    }
}//end of function

