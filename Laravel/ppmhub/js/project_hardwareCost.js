/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//add file after global vars , material , tasks ..etc
hardware_meta = [];
hardware_meta.push({name: "project_number", label: "Project Number", datatype: "string", 'editable': false});
hardware_meta.push({name: "task", label: "Task", datatype: "string", 'editable': true, 'values': tasks});
hardware_meta.push({name: "hardware_item_descripton", label: "Hardware Item Description", datatype: "string", 'editable': true});
hardware_meta.push({name: "purchase_order", label: "Requisition No", datatype: "string", 'editable': true, 'values': purchase_order});
hardware_meta.push({name: "po_item_no", label: "Item No", datatype: "string", 'editable': true, 'values': purchase_item});
hardware_meta.push({name: "type", label: "Type", datatype: "string", 'editable': true, 'values': {'Capex': 'Capex', 'Opex': 'Opex'}});
hardware_meta.push({name: "total_price", label: "Total Price", datatype: "double", 'editable': true});
hardware_meta.push({name: "currency", label: "Currency", datatype: "string", 'editable': true, 'values': {0:currency}});
hardware_meta.push({name: "action", label: "Action", datatype: "html", 'editable': false});
hardware_data = result;
//start of doc ready
(function () {
    /*--------------------------------------------------------------------------------------*/
    hardwareCostPlan = new EditableGrid("harwareCost", {
        enableSort: false,
        // called when some value has been modified: we display a message
        modelChanged: function (rowIdx, colIdx, oldValue, newValue, row) {

            if (this.hasColumn('po_item_no')) {

                this.setEnumProvider("po_item_no", new EnumProvider({
                    // the function getOptionValuesForEdit is called each time the cell is edited
                    // here we do only client-side processing, but you could use Ajax here to talk with your server
                    // if you do, then don't forget to use Ajax in synchronous mode 
                    getOptionValuesForEdit: function (grid, column, rowIndex) {

                        var po = hardwareCostPlan.getValueAt(rowIndex, hardwareCostPlan.getColumnIndex("purchase_order"));
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


            if (row.id != 'hardwareCost_total_cost') { // ignore the last row

                if ((colIdx == 3) || (colIdx == 4))
                {
                    var project = row.querySelector('.editablegrid-project_number').innerText;
                    var requisition = row.querySelector('.editablegrid-purchase_order').innerText;
                    var requisition_item = row.querySelector('.editablegrid-po_item_no').innerText;
                    if (requisition != '') {
                        $.ajax({
                            url: "/../admin/projectcostplan/requisition/0",
                            method: "POST",
                            data: {'_token': token, 'data': {'project': project, 'purchase_order': requisition, 'requisition_item': requisition_item}},
                            dataType: "JSON "
                        }).done(function (msg) {
                            if ('status' in msg)
                            {
                                if (msg.status != 'ok')
                                {
                                    _$("message").innerHTML = "<p class='err'> Could not find  Requisition item unit rate !.</p>";
                                    row.querySelector('.editablegrid-total_price').innerText = '';
                                    row.querySelector('.editablegrid-currency').innerText = '';

                                    return null;
                                }
                                else
                                {
                                    _$("message").innerHTML = "";
                                    row.querySelector('.editablegrid-total_price').innerText = (isNaN(msg.data.unit_rate) == false) ? parseFloat(msg.data.unit_rate).toFixed(2) : '';
                                    row.querySelector('.editablegrid-currency').innerText = (msg.data.currency != '') ? msg.data.currency : '';

                                }

                            }
                            else {
                                window.location.href = window.location.href;

                            }

                        });
                    }
                }


                if (row.id.indexOf('add') == -1) { //update cost 
                    var elements = row.querySelectorAll('td');
                    var id = row.id.split('_')[1];
                    var dataObj = {};
                    var flag = true;
                    $(elements).each(function (i, ele) {
                        if (ele.className !== 'editablegrid-action')
                        {

                            if (ele.innerText == '')
                            {
                                if (ele.className.indexOf('editablegrid-purchase_order') == -1 && ele.className.indexOf('editablegrid-po_item_no') == -1)
                                {
                                    flag = false;
                                }
                                else
                                {
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = '';
                                }


                            }
                            else
                            {
                                if (colIdx == 3 && ele.className == 'editablegrid-purchase_order')
                                {
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = newValue;

                                }
                                else if (colIdx == 1 && ele.className == 'editablegrid-task')
                                {
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = newValue;
                                }

                                if (colIdx == 4 && ele.className == 'editablegrid-po_item_no')
                                {
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = newValue;

                                }
                                else
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = ele.innerText;
                            }

                        }
                    });
                    if (flag == true) {

                        update_cost('hardware', dataObj, id);
                        _$("message").innerHTML = "<p class='ok'>New value is  '" + newValue + "', Added successfully </p>";
                        setTimeout(function () {

                            window.location.href = window.location.href;
                        }, 100);
                    }
                    else
                    {
                        console.log('material', dataObj, id);
                        _$("message").innerHTML = "<p class='err'>New value is '" + newValue + "', Updated Pending, Row Can't have empty fields </p>";
                    }

                }
                else { // add cost

                    var elements = row.querySelectorAll('td');
                    var dataObj = {};
                    var flag = true;
                    $(elements).each(function (i, ele) {
                        if (ele.className !== 'editablegrid-action')
                        {
                            if (ele.innerText == '')
                            {
                                if (ele.className.indexOf('editablegrid-purchase_order') == -1 && ele.className.indexOf('editablegrid-po_item_no') == -1)
                                {
                                    flag = false;
                                }
                                else
                                {
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = '';
                                }

                            }
                            else
                            {

                                if (colIdx == 3 && ele.className == 'editablegrid-purchase_order')
                                {
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = newValue;

                                }
                                else if (colIdx == 1 && ele.className == 'editablegrid-task')
                                {
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = newValue;
                                }

                                if (colIdx == 4 && ele.className == 'editablegrid-po_item_no')
                                {
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = newValue;

                                }
                                else
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = ele.innerText;
                            }

                        }
                    });
                    if (flag == true) {

                        add_cost('hardware', dataObj);

                    } else {
                        console.log('material', dataObj);
                        _$("message").innerHTML = "<p class='err'>New value is '" + newValue + ", Updated Pending, Row Can't have empty fields </p>";
                    }
                }
            }


        }

    });
    hardwareCostPlan.setActions = function () {
        //_$("message").innerHTML = "<p class='ok'>Ready!</p>";
        this.setCellRenderer("action", new CellRenderer({render: function (cell, value) {

                if (value != 'blank')
                    var index = cell.rowIndex;
                var html = '';
                var id = hardwareCostPlan.getRowId(index).toString();
                if (id != '-1')
                {
                    if (id.indexOf('add') == -1)
                    {
                        html = "delete_cost('hardware'," + id + ");setTimeout(function(){window.location.href = window.location.href;   },500);";
                    }
                    else {
                        html = "hardwareCostPlan.remove(" + cell.rowIndex + ")";
                    }
                    cell.innerHTML = "<a onclick=\"if (confirm('Are you sure you want to delete this record ? ')){ " + html + "}\" style=\"cursor:pointer\">" +
                            "<img src=\"/../vendors/editable-grid/delete.png\" border=\"0\" alt=\"delete\" title=\"delete\"/></a>";
                }
            }}));
        this.renderGrid("grid_cost", "testgrid");
    };
    hardwareCostPlan.editCell = function (rowIndex, columnIndex)
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
    hardwareCostPlan.isEditable = function (rowid, colid) {
//        if (hardwareCostPlan.getRowId(rowid).toString().indexOf('add') == -1 && (colid == 3 || colid == 4)) {
//            console.log(colid);
//            return false
//        }
        // else
        {
            return true
        }
    }
    hardwareCostPlan.load({"metadata": hardware_meta, "data": hardware_data});
    hardwareCostPlan.renderGrid("grid_cost", "testgrid");

    hardwareCostPlan.setActions();
})()//end of doc ready


