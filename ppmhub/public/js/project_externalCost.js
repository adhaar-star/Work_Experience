/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//add file after global vars , material , tasks ..etc
var modalChange = false;
external_meta = [];
external_meta.push({name: "project_number", label: "Project Number", datatype: "string", 'editable': false});
external_meta.push({name: "task", label: "Task", datatype: "string", 'editable': true, 'values': tasks});
external_meta.push({name: "resource role", label: "Resource Role", datatype: "string", 'editable': true, 'values': roles});
external_meta.push({name: "resource_name", label: "Resource Name", datatype: "string", 'editable': true, 'values': resources});
external_meta.push({name: "contract_vendor", label: "Contract Vendor", datatype: "string", 'editable': true, 'values': vendors});
external_meta.push({name: "purchase_order", label: "Requisition No", datatype: "string", 'editable': true, 'values': purchase_order});
external_meta.push({name: "requisition_item", label: "Requisition Item No", datatype: "string", 'editable': true, 'values': purchase_item});
external_meta.push({name: "activity_type", label: "Activity Type", datatype: "string", 'editable': true, 'values': activities});
external_meta.push({name: "type", label: "Type", datatype: "string", 'editable': true, 'values': {'Capex':'Capex','Opex':'Opex'}});
//external_meta.push({name: "no_hours", label: "No Hours", datatype: "string", 'editable': true});


var hours = [];
$(result).each(function (i, obj) {
    if ('no_hours' in obj.values && obj.values['no_hours'] != null) {
        var monthsData = JSON.parse(obj.values['no_hours'], true);
        for (var key in monthsData) {
            console.log(checkExist(external_meta, 'noHour_' + key, true));
            if (!checkExist(external_meta, 'noHour_' + key, true)) {
                external_meta.push({name: 'noHour_' + key, label: key, datatype: "interger", 'editable': true});
            }
        }
        if (!checkExist(external_meta, 'noOfHour', true)) {
            external_meta.push({name: 'noOfHour', label: 'No of hrs', datatype: "interger", 'editable': false});
        }
    }
});



external_meta.push({name: "unit_rate", label: "Unit Rate", datatype: "integer", 'editable': true});
external_meta.push({name: "total_price", label: "Total Price", datatype: "string", 'editable': false});
external_meta.push({name: "currency", label: "Currency", datatype: "string", 'editable': true, 'values': {0:currency}});
external_meta.push({name: "action", label: "Action", datatype: "html", 'editable': false});
external_data = result;
function checkExist(inArr, name, exists) {
    for (var i = 0; i < inArr.length; i++) {
        if (inArr[i].name == name) {
            return (exists === true) ? true : inArr[i];
        }
    }
}
//start of doc ready
(function () {
    /*--------------------------------------------------------------------------------------*/
    externalCostPlan = new EditableGrid("externalCost", {
        enableSort: false,
        // called when some value has been modified: we display a message
        modelChanged: function (rowIdx, colIdx, oldValue, newValue, row) {
            if (this.hasColumn('requisition_item')) {

                this.setEnumProvider("requisition_item", new EnumProvider({
                    // the function getOptionValuesForEdit is called each time the cell is edited
                    // here we do only client-side processing, but you could use Ajax here to talk with your server
                    // if you do, then don't forget to use Ajax in synchronous mode 
                    getOptionValuesForEdit: function (grid, column, rowIndex) {

                        var po = externalCostPlan.getValueAt(rowIndex, externalCostPlan.getColumnIndex("purchase_order"));
                        var optoions;
                        if (po != "")
                            $.ajax({
                                url: "/admin/projectcostplan/purchaseorderdata/" + po,
                                method: "POST",
                                async: false,
                                data: {'_token': token},
                                dataType: "JSON "
                            }).done(function (msg) {
                                console.log(msg.data);
                                options = msg.data;
                            });

                        return options;
                    }
                }));
            }


            if (row.id != 'externalCost_total_cost') { // ignore the last row
                if (colIdx == 1 || colIdx == 2)
                {
                    project_id = row.querySelector('.editablegrid-project_number').innerText;
                    task = externalCostPlan.data[rowIdx].columns[1];
                    role = externalCostPlan.data[rowIdx].columns[2];;
                    if (role != '' && task != '' && project_id != '')
                    {
                        $.ajax({
                            url: "/../admin/projectcostplan/taskassignement/0",
                            method: "POST",
                            data: {'_token': token, 'data': {'project_id': project_id, 'task': task, 'role': role}},
                            dataType: "JSON "
                        }).done(function (msg) {
                            if ('status' in msg)
                            {
                                if (msg.status != 'ok')
                                {

                                    row.querySelector('.editablegrid-resource_name').innerText = '';
                                    externalCostPlan.data[rowIdx].columns[3] = '';

                                    _$("message").innerHTML = "<p class='err'> Could not find  activity rate !.</p>";
                                    return null;
                                }
                                else
                                {
                                    _$("message").innerHTML = "";
                                    row.querySelector('.editablegrid-resource_name').innerText = msg.data.resource_name;
                                    externalCostPlan.data[rowIdx].columns[3] =  msg.data.resource_name;

                                }

                            }
                            else {
                                window.location.href = window.location.href;

                            }

                        });
                    }
                }
                if ((colIdx == 7)) {
                    $.ajax({
                        url: "/../admin/projectcostplan/activity/0",
                        method: "POST",
                        data: {'_token': token, 'data': newValue},
                        dataType: "JSON "
                    }).done(function (msg) {
                        if ('status' in msg)
                        {
                            if (msg.status != 'ok')
                            {
                                externalCostPlan.data[rowIdx].columns[externalCostPlan.data[rowIdx].columns.length - 4] = '';
                                _$("message").innerHTML = "<p class='err'> Could not find  activity rate !.</p>";
                                return null;
                            }
                            else
                            {
                                _$("message").innerHTML = "";
                                row.querySelector('.editablegrid-unit_rate').innerText = (isNaN(msg.data.activity_actual_rate) == false) ? parseFloat(msg.data.activity_actual_rate).toFixed(2) : '';
                                externalCostPlan.data[rowIdx].columns[externalCostPlan.data[rowIdx].columns.length - 4] = (isNaN(msg.data.activity_actual_rate) == false) ? parseFloat(msg.data.activity_actual_rate).toFixed(2) : '';
                            }

                        }
                        else {
                            window.location.href = window.location.href;

                        }

                    });
                }

                if ((colIdx == 5) || (colIdx == 6))
                {
                    var requisition = row.querySelector('.editablegrid-purchase_order').innerText;
                    var requisition_item = row.querySelector('.editablegrid-requisition_item').innerText;
                    if (requisition != '') {
                        $.ajax({
                            url: "/../admin/projectcostplan/requisition/0",
                            method: "POST",
                            data: {'_token': token, 'data': {'purchase_order': requisition, 'requisition_item': requisition_item}},
                            dataType: "JSON "
                        }).done(function (msg) {
                            if ('status' in msg)
                            {
                                if (msg.status != 'ok')
                                {
                                    _$("message").innerHTML = "<p class='err'> Could not find  Requisition item unit rate !.</p>";
                                    row.querySelector('.editablegrid-unit_rate').innerText = '';
                                    row.querySelector('.editablegrid-currency').innerText = '';
                                    externalCostPlan.data[rowIdx].columns[externalCostPlan.data[rowIdx].columns.length - 4] = '';
                                    externalCostPlan.data[rowIdx].columns[externalCostPlan.data[rowIdx].columns.length - 2] = '';
                                    return null;
                                }
                                else
                                {
                                    _$("message").innerHTML = "";
                                    row.querySelector('.editablegrid-unit_rate').innerText = (isNaN(msg.data.unit_rate) == false) ? parseFloat(msg.data.unit_rate).toFixed(2) : '';
                                    row.querySelector('.editablegrid-currency').innerText = (msg.data.currency != '') ? msg.data.currency : '';
                                    externalCostPlan.data[rowIdx].columns[externalCostPlan.data[rowIdx].columns.length - 4] = (isNaN(msg.data.unit_rate) == false) ? parseFloat(msg.data.unit_rate).toFixed(2) : '';
                                    externalCostPlan.data[rowIdx].columns[externalCostPlan.data[rowIdx].columns.length - 2] = (msg.data.currency != '') ? msg.data.currency : '';
                                }

                            }
                            else {
                                window.location.href = window.location.href;

                            }

                        });
                    }
                }


                modalChange = true;
                costCalculation(row, newValue, rowIdx);
            }
        }
    });
    externalCostPlan.setActions = function () {
        //_$("message").innerHTML = "<p class='ok'>Ready!</p>";
        this.setCellRenderer("action", new CellRenderer({render: function (cell, value) {

                if (value != 'blank')
                    var index = cell.rowIndex;
                var html = '';
                var id = externalCostPlan.getRowId(index).toString();
                if (id != '-1')
                {
                    if (id.indexOf('add') == -1)
                    {
                        html = "delete_cost('external'," + id + ");setTimeout(function(){window.location.href = window.location.href;   },500);";
                    }
                    else {
                        html = "externalCostPlan.remove(" + cell.rowIndex + ")";
                    }
                    cell.innerHTML = "<a onclick=\"if (confirm('Are you sure you want to delete this record ? ')){ " + html + "}\" style=\"cursor:pointer\">" +
                            "<img src=\"/../vendors/editable-grid/delete.png\" border=\"0\" alt=\"delete\" title=\"delete\"/></a>";
                }
            }}));
        this.renderGrid("grid_cost", "testgrid", "tableid");
    };
    externalCostPlan.editCell = function (rowIndex, columnIndex)
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
    externalCostPlan.load({"metadata": external_meta, "data": external_data});
    externalCostPlan.renderGrid("grid_cost", "testgrid", "tableid");
    externalCostPlan.setActions();
    $('[name=from_date],[name=to_date]').on('dp.change', function () {
        getDateCols();
    });
    var min_date = max_date = moment();
    $(result).each(function (i, data) {
        Object.keys(data.values).filter(function (key) {
            var min;
            if (key.indexOf('noHour_') != -1)//change as per you data
            {
                console.log(key.split('_')[1]);
                var m = moment(key.split('_')[1], 'MMM_YYYY');
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
})();//end of doc ready




function costCalculation(row, newValue, rowIdx) {
    var id = row.id.split('_')[1];
    var validateFields = ['editablegrid-type','editablegrid-task', 'editablegrid-resource role','editablegrid-unit_rate', 'editablegrid-project_number', 'editablegrid-total_price', 'editablegrid-currency'];
    var dataObj = {};
    var flag = true;
    var no_of_hours = 0;
    var element = row.querySelectorAll('td');
    $(element).each(function (i, ele) {
        if (ele.className !== 'editablegrid-action' && ele.className !== 'editablegrid-total_price') {
            if (validateFields.indexOf(ele.className) > -1) {
                if (ele.innerText == '') {
                    flag = false;
                }
            }
        }
        if (ele.className.indexOf('noHour_') != -1) {
            if (ele.innerText != '') {

                if (parseInt(ele.innerText) > 240)
                {
                    ele.innerText = 240;
                    no_of_hours = no_of_hours + parseInt(ele.innerText);

                }
                else {

                    no_of_hours = no_of_hours + parseInt(ele.innerText);
                }

            }
        }
        if (row.querySelector('.editablegrid-noOfHour') != null && row.querySelector('.editablegrid-noOfHour') != undefined) {
            row.querySelector('.editablegrid-noOfHour').innerText = no_of_hours == 0 ? 0 : parseInt(no_of_hours);
            if (externalCostPlan.data[rowIdx] != undefined)
                externalCostPlan.data[rowIdx].columns[externalCostPlan.data[rowIdx].columns.length - 5] = no_of_hours == 0 ? 0 : parseInt(no_of_hours);

            if (no_of_hours != 0 && row.querySelector('.editablegrid-unit_rate').innerText != '') {
                var totalPrice = no_of_hours * parseFloat(row.querySelector('.editablegrid-unit_rate').innerText);
                row.querySelector('.editablegrid-total_price').innerText = totalPrice == 0 ? 0 : parseFloat(totalPrice);
                if (rowIdx > 0)
                    externalCostPlan.data[rowIdx].columns[externalCostPlan.data[rowIdx].columns.length - 3] = totalPrice == 0 ? 0 : parseFloat(totalPrice);
            }
        }
        var totalCost = 0;
        var totalHours = 0;
        var length = $('td.editablegrid-total_price').length;
        $('td.editablegrid-total_price').each(function (i, ele) {
            if (i < length - 1 && ele.innerText != '')
            {
                totalCost += parseFloat(ele.innerText);
            }
        });
        $('td.editablegrid-total_price').eq(length - 1).text(totalCost == 0 ? 0 : parseFloat(totalCost));
        $('td.editablegrid-noOfHour').each(function (i, ele) {
            if (i < length - 1 && ele.innerText != '')
            {
                totalHours += parseInt(ele.innerText);
            }
        });
        $('td.editablegrid-noOfHour').eq(length - 1).text(totalHours == 0 ? 0 : parseInt(totalHours));
        dataObj[ele.className.split('-')[1]] = ele.innerText;
    });
    if (flag == true) {
        if (row.id.indexOf('add') == -1) {//update cost 
            update_cost('external', dataObj, id);
            if (modalChange) {
                _$("message").innerHTML = "<p class='ok'>New value is  '" + newValue + "', Added successfully </p>";
            }
        } else {
            add_cost('external', dataObj);
            _$("message").innerHTML = "<p class='err'> added external data Successfully!!.</p>";
            setTimeout(function () {
                window.location.href = window.location.href;
            }, 500);
        }

    } else {
        _$("message").innerHTML = "<p class='err'>New value is '" + newValue + "', Updated Pending, Row Can't have empty fields </p>";
    }
}
function getDateCols() {
    from = $('[name=from_date]').val();
    to = $('[name=to_date]').val();
    modalChange = false;
    if (to != '' && from != '')
    {
        _$("message").innerHTML = '';
        fromM = moment(from);
        toM = moment(to);
        if (fromM.month() < toM.month() || fromM.month() == toM.month()) {
            meta = [];
            meta.push({name: "project_number", label: "Project Number", datatype: "string", 'editable': false});
            meta.push({name: "task", label: "Task", datatype: "string", 'editable': true, 'values': tasks});
            meta.push({name: "resource role", label: "Resource Role", datatype: "string", 'editable': true, 'values': roles});
            meta.push({name: "resource_name", label: "Resource Name", datatype: "string", 'editable': true, 'values': resources});
            meta.push({name: "contract_vendor", label: "Contract Vendor", datatype: "string", 'editable': true, 'values': vendors});
            meta.push({name: "purchase_order", label: "Requisition No", datatype: "string", 'editable': true, 'values': purchase_order});
            meta.push({name: "requisition_item", label: "Requisition Item No", datatype: "string", 'editable': true, 'values': purchase_item});
            meta.push({name: "activity_type", label: "Activity Type", datatype: "string", 'editable': true, 'values': activities});
            meta.push({name: "type", label: "Type", datatype: "string", 'editable': true, 'values': {'Capex':'Capex','Opex':'Opex'}});
            toM.format("MMM").toLowerCase();
            if (parseInt(fromM.year()) == parseInt(toM.year())) {
                for (i = parseInt(fromM.format('M')); i <= parseInt(toM.format('M')); i++) {
                    var m = moment([parseInt(fromM.year()), i - 1]).format('MMM_YYYY');
                    var name = 'noHour_' + m.toLowerCase();
                    console.log('name', name);
                    meta.push({name: name, label: m, datatype: "integer", 'editable': true, values: 0});
                }
            } else {
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
            meta.push({name: 'noOfHour', label: 'No of hrs', datatype: "interger", 'editable': false});
            meta.push({name: "unit_rate", label: "Unit Rate", datatype: "integer", 'editable': true});
            meta.push({name: "total_price", label: "Total Price", datatype: "string", 'editable': false});
            meta.push({name: "currency", label: "Currency", datatype: "string",  'editable': true, 'values': {0:currency}});
            meta.push({name: "action", label: "Action", datatype: "html", 'editable': false});
            externalCostPlan.load({"metadata": meta, "data": external_data});
            externalCostPlan.setActions();
            if ($(".testgrid tbody tr").length > 1) {
                $('.testgrid [id^=externalCost_]').each(function (key, element) {
                    if ($(this).attr('id') !== 'externalCost_total_cost') {
                        costCalculation(element, '');
                    }
                });
            }
        }
        else {
            _$("message").innerHTML = "<p class='err'> 'To Date' can't be before the 'From Date' </p>";
        }
    }
}