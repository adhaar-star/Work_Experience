/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//add file after global vars , material , tasks ..etc
internal_meta = [];
internal_meta.push({name: "project_number", label: "Project Number", datatype: "string", 'editable': false});
internal_meta.push({name: "task", label: "Task", datatype: "string", 'editable': true, 'values': tasks});
internal_meta.push({name: "resource_role", label: "Resource Role", datatype: 'string', 'editable': true, 'values': roles});
internal_meta.push({name: "personal_no", label: "Personnel No", datatype: "string", 'editable': true, 'values': personnel_no});
internal_meta.push({name: "resource_name", label: "Resource Name", datatype: "string", 'editable': false, 'values': resources});
internal_meta.push({name: "activity_type", label: "Activity Type", datatype: "string", 'editable': true});

internal_meta.push({name: "type", label: "Type", datatype: "string", 'editable': true, 'values': {'Service': 'Service'}});
internal_meta.push({name: "unit_price", label: "Unit Rate", datatype: "double", 'editable': false});
internal_meta.push({name: "total_price", label: "Total Price", datatype: "double", 'editable': false});
internal_meta.push({name: "currency", label: "Currency", datatype: "string",  'editable': true, 'values':currency});
internal_meta.push({name: "action", label: "Action", datatype: "html", 'editable': false});
internal_data = result;

//start of doc ready
(function () {
    /*--------------------------------------------------------------------------------------*/
    internalCostPlan = new EditableGrid("internalCost", {
        enableSort: false,
        // called when some value has been modified: we display a message
        modelChanged: function (rowIdx, colIdx, oldValue, newValue, row) {

            if (colIdx == 1 || colIdx == 2)
            {
                project_id = row.querySelector('.editablegrid-project_number').innerText;
                task = internalCostPlan.data[rowIdx].columns[1];
                role = internalCostPlan.data[rowIdx].columns[2];
                if (role != '' && task != '' && project_id != '')
                {
                    $.ajax({
                        url: "/../admin/projectrevenueplan/taskassignement/0",
                        method: "POST",
                        data: {'_token': token, 'data': {'project_id': project_id, 'task': task, 'role': role}},
                        dataType: "JSON "
                    }).done(function (msg) {
                        if ('status' in msg)
                        {
                            if (msg.status != 'ok')
                            {
                                row.querySelector('.editablegrid-personal_no').innerText = '';
                                row.querySelector('.editablegrid-resource_name').innerText = '';
                                internalCostPlan.data[rowIdx].columns[3] = '';
                                internalCostPlan.data[rowIdx].columns[4] = '';
                                _$("message").innerHTML = "<p class='err'> Could not find  activity rate !.</p>";
                                return null;
                            }
                            else
                            {
                                _$("message").innerHTML = "";
                                row.querySelector('.editablegrid-personal_no').innerText = msg.data.resource_id;
                                row.querySelector('.editablegrid-resource_name').innerText = msg.data.resource_name;
                                internalCostPlan.data[rowIdx].columns[3] = msg.data.resource_id;
                                internalCostPlan.data[rowIdx].columns[4] = msg.data.resource_name;

                            }

                        }
                        else {
                            window.location.href = window.location.href;

                        }

                    });
                }
            }
            if (colIdx == 3)
            {
                var resource_id = row.querySelector('.editablegrid-personal_no').innerText;
                if (resource_id != '')
                {
                    $.ajax({
                        url: "/../admin/projectrevenueplan/getresource/0",
                        method: "POST",
                        data: {'_token': token, 'data': {'resource_id': resource_id}},
                        dataType: "JSON "
                    }).done(function (msg) {
                        if ('status' in msg)
                        {
                            if (msg.status != 'ok')
                            {
                                row.querySelector('.editablegrid-resource_name').innerText = '';
                                internalCostPlan.data[rowIdx].columns[4] = '';
                                _$("message").innerHTML = "<p class='err'> Could not find  activity rate !.</p>";
                                return null;
                            }
                            else
                            {
                                _$("message").innerHTML = "";
                                row.querySelector('.editablegrid-resource_name').innerText = msg.data.resource_name;
                                internalCostPlan.data[rowIdx].columns[4] = msg.data.resource_name;

                            }

                        }
                        else {
                            window.location.href = window.location.href;

                        }

                    });
                }
            }

            if (colIdx == 5)
            {

                $.ajax({
                    url: "/../admin/projectrevenueplan/activity/0",
                    method: "POST",
                    data: {'_token': token, 'data': newValue},
                    dataType: "JSON "
                }).done(function (msg) {
                    if ('status' in msg)
                    {
                        if (msg.status != 'ok')
                        {
                            _$("message").innerHTML = "<p class='err'> Could not find  activity rate !.</p>";
                            return null;
                        }
                        else
                        {
                            _$("message").innerHTML = "";
                            row.querySelector('.editablegrid-unit_price').innerText = (isNaN(msg.data.billing_rate) == false) ? parseFloat(msg.data.billing_rate).toFixed(2) : '';
                            internalCostPlan.data[rowIdx].columns[internalCostPlan.data[rowIdx].columns.length - 4] = (isNaN(msg.data.billing_rate) == false) ? parseFloat(msg.data.billing_rate).toFixed(2) : '';
                        }

                    }
                    else {
                        window.location.href = window.location.href;

                    }

                });
            }

            if (row.id != 'internalCost_total_cost') { // ignore the last row

                //--------- add the hours and get prics ready-----------// 
                var sum_of_hours = 0;
                var element = row.querySelectorAll('td');
                $(element).each(function (i, ele) {

                    if (ele.className.indexOf('-hours-') != -1)
                    {
                        if (ele.innerText != '')
                        {
                            if (parseInt(ele.innerText) > 240)
                            {
                                ele.innerText = 240;
                                sum_of_hours = sum_of_hours + parseInt(ele.innerText);
                            }
                            else {

                                sum_of_hours = sum_of_hours + parseInt(ele.innerText);
                            }
                        }
                    }
                });
                if (isNaN(sum_of_hours))
                    sum_of_hours = 0;
                row.querySelector('.editablegrid-total_hours').innerText = sum_of_hours;
                internalCostPlan.data[rowIdx].columns[internalCostPlan.data[rowIdx].columns.length - 5] = sum_of_hours;
                row.querySelector('.editablegrid-total_price').innerText = parseFloat((sum_of_hours) * (isNaN(parseFloat(row.querySelector('.editablegrid-unit_price').innerText).toFixed(2)) ? 0 : parseFloat(row.querySelector('.editablegrid-unit_price').innerText).toFixed(2))).toFixed(2);
                internalCostPlan.data[rowIdx].columns[internalCostPlan.data[rowIdx].columns.length - 3] = parseFloat(row.querySelector('.editablegrid-total_price').innerText).toFixed(2);
                var length = $('td.editablegrid-total_price').length;
                var total_ammount = 0;
                $('td.editablegrid-total_price').each(function (i, ele) {

                    if (i < length - 1)
                    {
//                        console.log(total_ammount);
                        if (!isNaN(parseFloat(ele.innerText)))
                            total_ammount += (parseFloat(ele.innerText));
                    }
                });
                $('td.editablegrid-total_price').eq(length - 1).text(isNaN(total_ammount.toFixed(2)) ? '' : total_ammount.toFixed(2));
                //--------- add the hours and get prics ready-----------// 


                if (row.id.indexOf('add') == -1) { //update cost 
                    var elements = row.querySelectorAll('td');
                    var id = row.id.split('_')[1];
                    var dataObj = {};
                    var flag = true;
                    var element = row.querySelectorAll('td');
                    $(element).each(function (i, ele) {
                        if (ele.className !== 'editablegrid-action' && ele.className.indexOf('editablegrid-total_hours') == -1)
                        {

                            if (ele.innerText == '' && ele.className.indexOf('hours-') == -1 && ele.className.indexOf('editablegrid-resource_id') == -1 && ele.className.indexOf('editablegrid-resource_name') == -1 && ele.className.indexOf('editablegrid-resource_role') == -1 && ele.className.indexOf('editablegrid-task') == -1)
                            {
                                flag = false;
                            }
                            else
                            {

                                if (i > 6 && ele.className.indexOf('nan') == -1 && ele.className.indexOf('-hours-') != -1 && i < internalCostPlan.getColumnCount() - 5)
                                {
                                    dataObj['hours-' + ele.className.split('-')[2].replace(' nan', '')] = ele.innerText;
//                                    console.log(ele.className.split('-')[2].replace(' nan', ''));
                                }
                                else
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = ele.innerText;
                            }

                        }
                    });
                    if (flag == true) {

                        //console.log('material', dataObj, id);
                        update_revenue('service-offering', dataObj, id);
                        _$("message").innerHTML = "<p class='ok'>New value is  '" + newValue + "', Added successfully </p>";
                        setTimeout(function () {

                            window.location.href = window.location.href;
                        }, 500);
                    }
                    else
                    {
//                        console.log('internal', dataObj, id);
                        _$("message").innerHTML = "<p class='err'>New value is '" + newValue + "', Updated Pending, Row Can't have empty fields </p>";
                    }

                }
                else { // add cost
                    var elements = row.querySelectorAll('td');
                    dataObj2 = {};
                    var flag = true;
                    var element = row.querySelectorAll('td');
                    $(element).each(function (i, ele) {
                        if (ele.className !== 'editablegrid-action' && ele.className.indexOf('editablegrid-total_hours') == -1)
                        {

                            if (ele.innerText == '' && ele.className.indexOf('hours-') == -1 && ele.className.indexOf('editablegrid-resource_name') == -1 && ele.className.indexOf('editablegrid-resource_role') == -1 && ele.className.indexOf('editablegrid-task') == -1)
                            {
                                flag = false;
                            }
                            else
                            {

                                if (i > 6 && ele.className.indexOf('nan') == -1 && ele.className.indexOf('-hours-') != -1 && i < internalCostPlan.getColumnCount() - 5)
                                {
                                    dataObj2['hours-' + ele.className.split('-')[2].replace(' nan', '')] = ele.innerText;
//                                    console.log(ele.className.split('-')[2]);
                                }
                                else if ((i <= 6 || i >= internalCostPlan.getColumnCount() - 5) && ele.className.indexOf('-hours-') == -1)
                                {
                                    dataObj2[ele.className.split('-')[1].replace(' nan', '')] = ele.innerText;
//                                    console.log(ele.className.split('-')[1]);
                                }
                            }

                        }
                    });
                    if (flag == true) {

                        //console.log('material', dataObj, id);
                        add_revenue('service-offering', dataObj2);
                        _$("message").innerHTML = "<p class='ok'>New value is  '" + newValue + "', Added successfully </p>";
                        setTimeout(function () {

                            window.location.href = window.location.href;
                        }, 500);
                    }
                    else
                    {
//                        console.log('internal', dataObj2);
                        _$("message").innerHTML = "<p class='err'>New value is '" + newValue + "', Updated Pending, Row Can't have empty fields </p>";
                    }
                }
            }


        }

    });


    internalCostPlan.setActions = function () {
        //_$("message").innerHTML = "<p class='ok'>Ready!</p>";
        this.setCellRenderer("action", new CellRenderer({render: function (cell, value) {

                if (value != 'blank')
                    var index = cell.rowIndex;
                var html = '';
                var id = internalCostPlan.getRowId(index).toString();
                if (id != '-1')
                {
                    if (id.indexOf('add') == -1)
                    {
                        html = "delete_revenue('service-offering'," + id + ");setTimeout(function(){window.location.href = window.location.href;   },500);";
                    }
                    else {
                        html = "internalCostPlan.remove(" + cell.rowIndex + ")";
                    }
                    cell.innerHTML = "<a onclick=\"if (confirm('Are you sure you want to delete this record ? ')){ " + html + "}\" style=\"cursor:pointer\">" +
                            "<img src=\"/../vendors/editable-grid/delete.png\" border=\"0\" alt=\"delete\" title=\"delete\"/></a>";
                }
            }}));
        this.renderGrid("grid_cost", "testgrid");
    };
    internalCostPlan.editCell = function (rowIndex, columnIndex)
    {
        if (rowIndex < this.getRowCount() - 1)
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
                }
                else {
                    if (rowIndex < 0) {
                        if (column.headerEditor && isHeaderEditable(rowIndex, columnIndex))
                            column.headerEditor.edit(rowIndex, columnIndex, target, column.label);
                    }
                    else if (column.cellEditor && isEditable(rowIndex, columnIndex))
                        column.cellEditor.edit(rowIndex, columnIndex, target, getValueAt(rowIndex, columnIndex));
                }
            }
        }
    };
    internalCostPlan.load({"metadata": internal_meta, "data": internal_data});
    internalCostPlan.renderGrid("grid_cost", "testgrid");
    internalCostPlan.setActions();

    $('[name=from_date],[name=to_date]').on('dp.change', function () {
        getDateCols();
    });




    // month column auto load code 
    // get min month and max month then render with data

    var min_date = max_date = moment();
    $(result).each(function (i, data) {
        Object.keys(data.values).filter(function (key) {
            var min;
            if (key.indexOf('hours-') != -1)//change as per you data
            {
//                console.log(key.split('-')[1]);
                var m = moment(key.split('-')[1], 'MMM_YYYY');
                if (m.isBefore(min_date))
                {
                    min_date = m;
                }
                else if (m.isAfter(max_date))
                {
                    max_date = m;
                }
            }
        })
    });
    $('[name=from_date]').val(min_date.format('YYYY-MM-DD'));
    $('[name=to_date]').val(max_date.format('YYYY-MM-DD'));
    $('[name=to_date]').trigger('dp-change');
})()//end of doc ready


function getDateCols() {

    from = $('[name=from_date]').val();
    to = $('[name=to_date]').val();

    if (to != '' && from != '')
    {
        fromM = moment(from);
        toM = moment(to);
        if (fromM.month() < toM.month() || fromM.month() == toM.month()) {
            _$("message").innerHTML = "";
            var diff = toM.diff(fromM, 'months', true);
//            console.log(diff);


            meta = [];
            meta.push({name: "project_number", label: "Project Number", datatype: "string", 'editable': false});
            meta.push({name: "task", label: "Task", datatype: "string", 'editable': true, 'values': tasks});
            meta.push({name: "resource_role", label: "Resource Role", datatype: 'string', editable: true, 'values': roles});
            meta.push({name: "personal_no", label: "Personnel No", datatype: "string", 'editable': true, 'values': personnel_no});
            meta.push({name: "resource_name", label: "Resource Name", datatype: "string", 'editable': false, 'values': resources});
            meta.push({name: "activity_type", label: "Activity Type", datatype: "string", 'editable': true, 'values': activities});
            meta.push({name: "type", label: "Type", datatype: "string", 'editable': true, 'values': {'Service': 'Service'}});
//          meta.push({name: "total_hours", label: "No Hours", datatype: "string", 'editable': true});


            toM.format("MMM").toLowerCase();

//            console.log(fromM.format('M'));
//            console.log(toM.format('M'));
            for (i = parseInt(fromM.format('M')); i <= parseInt(toM.format('M')); i++) {
//                console.log(i);
//                console.log(fromM.year());
//                console.log(toM.year());

                if (fromM.year() == toM.year())
                {
//                    console.log('hello');
                    var m = moment([parseInt(fromM.year()), i - 1]).format('MMM_YYYY');
//                    console.log(m.toLowerCase());

                    meta.push({name: 'hours-' + m.toLowerCase(), label: m, datatype: "integer", 'editable': true});

                }
                else {
                    var fromMonth = parseInt(fromM.format('M'));
                    for (year = parseInt(fromM.year()); year <= parseInt(toM.year()); year++) {
                        for (i = fromMonth; i <= 12; i++) {
                            if (year == parseInt(toM.year()) && i > parseInt(toM.format('M'))) {
                                break;
                            }
                            var m = moment([parseInt(year), i - 1]).format('MMM_YYYY');
                            var name = 'noHour_' + m.toLowerCase();
                            meta.push({name: name, label: m, datatype: "integer", 'editable': true, values: 0});
                        }
                        fromMonth = parseInt(1);
                    }
                }
            }
            
            meta.push({name: "total_hours", label: "Total Hours", datatype: "integer", 'editable': false});
            meta.push({name: "unit_price", label: "Unit Rate", datatype: "double", 'editable': false});
            meta.push({name: "total_price", label: "Total Price", datatype: "double", 'editable': false});
            meta.push({name: "currency", label: "Currency", datatype: "string", 'editable': true, 'values':currency});
            meta.push({name: "action", label: "Action", datatype: "html", 'editable': false});
            internalCostPlan.load({"metadata": meta, "data": internal_data});
            internalCostPlan.setActions();

        }
        else
        {
            _$("message").innerHTML = "<p class='err'> 'To Date' can't be before the 'From Date' </p>";

        }



    }
    else
    {

    }
}