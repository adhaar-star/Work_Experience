/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//add file after global vars , material , tasks ..etc
material_meta = [];
material_meta.push({name: "project_number", label: "Project Number", datatype: "string", 'editable': false});
material_meta.push({name: "material_number", label: "Material Number", datatype: "string", 'editable': true, 'values': material});
material_meta.push({name: "task", label: "Task", datatype: "string", 'editable': true, 'values': tasks});
material_meta.push({name: "description", label: "Description", datatype: "string", 'editable': false});
material_meta.push({name: "quantity", label: "Qty", datatype: "integer", 'editable': true});
material_meta.push({name: "type", label: "Type", datatype: "string", 'editable': true, 'values': {'Capex': 'Capex','Opex': 'Opex',}});
material_meta.push({name: "unit_price", label: "Unit Price", datatype: "double", 'editable': false});
material_meta.push({name: "total_price", label: "Total Price", datatype: "double", 'editable': false});
material_meta.push({name: "currency", label: "Currency", datatype: "string", 'editable': true, 'values': {0:currency}});
material_meta.push({name: "action", label: "Action", datatype: "html", 'editable': false});

material_data = result || [];


//start of doc ready
(function () {
    /*--------------------------------------------------------------------------------------*/
    materialCostPlan = new EditableGrid("materialCost", {
        enableSort: false,
        // called when some value has been modified: we display a message
        modelChanged: function (rowIdx, colIdx, oldValue, newValue, row) {
            if (row.id != 'materialCost_total_cost') { // ignore the last row

                if (row.id.indexOf('add') == -1) { //update cost 
                    var elements = row.querySelectorAll('td');
                    var id = row.id.split('_')[1];
                    var dataObj = {};
                    var flag = true;
                    $(elements).each(function (i, ele) {

                        if (ele.className !== 'editablegrid-action' && ele.className.indexOf('editablegrid-total_price') == -1)
                        {

                            if (ele.innerText == '' || newValue == '')
                            {
                                flag = false;
                            }
                            else
                            {
                                if (colIdx == 1 && ele.className == 'editablegrid-material_number')
                                {
                                    if (newValue != '')
                                    {
                                        console.log(newValue);
                                        dataObj[ele.className.split('-')[1].replace(' nan', '')] = newValue;
                                        $.ajax({
                                            url: "/../admin/projectcostplan/materialdata/" + newValue,
                                            method: "POST",
                                            data: {'_token': token},
                                            dataType: "JSON "
                                        }).done(function (msg) {
                                            if ('status' in msg)
                                            {
                                                if (msg.status != 'ok')
                                                {
                                                    _$("message").innerHTML = "<p class='err'> Could not find  material data !.</p>";

                                                }
                                                else
                                                {
                                                    _$("message").innerHTML = "";
                                                    row.querySelector('.editablegrid-description').innerText = msg.data.material_description;
                                                    row.querySelector('.editablegrid-unit_price').innerText = (isNaN(msg.data.standard_price) == false) ? parseFloat(msg.data.standard_price).toFixed(2) : '';
                                                    row.querySelector('.editablegrid-currency').innerText = 'USD' || msg.data.currency;

                                                    if (msg.data.currency == '') {

                                                        materialCostPlan.columns[8].editable = true;
                                                    }
                                                    if (row.querySelector('.editablegrid-quantity').innerText != '')
                                                    {
                                                        row.querySelector('.editablegrid-total_price').innerText = parseInt(row.querySelector('.editablegrid-quantity').innerText) * parseFloat(row.querySelector('.editablegrid-unit_price').innerText);
                                                        var length = $('td.editablegrid-total_price').length;
                                                        var total_ammount = 0;
                                                        $('td.editablegrid-total_price').each(function (i, ele) {

                                                            if (i < length - 1)
                                                            {
                                                                total_ammount += parseInt(ele.innerText);
                                                            }
                                                        });
                                                        $('td.editablegrid-total_price').eq(length - 1).text(total_ammount);
                                                    }

                                                }

                                            }
                                            else {
                                                window.location.href = window.location.href;

                                            }

                                        });
                                    }
                                }
                                else if (colIdx == 2 && ele.className == 'editablegrid-task')
                                {
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = newValue;
                                }
                                else if (colIdx == 4 && ele.className == 'editablegrid-quantity')
                                {
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = newValue;
                                    row.querySelector('.editablegrid-total_price').innerText = parseInt(row.querySelector('.editablegrid-quantity').innerText) * parseFloat(row.querySelector('.editablegrid-unit_price').innerText);
                                    var length = $('td.editablegrid-total_price').length;
                                    var total_ammount = 0;
                                    $('td.editablegrid-total_price').each(function (i, ele) {
                                        console.log(ele, i);
                                        if (i < length - 1)
                                        {
                                            console.log(ele.innerText);
                                            total_ammount += parseInt(ele.innerText);
                                        }
                                    });
                                    $('td.editablegrid-total_price').eq(length - 1).text(total_ammount);
                                }
                                else if (colIdx == 8 && ele.className == 'editablegrid-currency')
                                {
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = newValue;
                                    materialCostPlan.columns[8].editable = false;
                                }
                                else
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = ele.innerText;
                            }

                        }
                    });

                    if (flag == true) {

                        //console.log('material', dataObj, id);
                        update_cost('material', dataObj, id);
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
                        if (ele.className !== 'editablegrid-action' && ele.className.indexOf('editablegrid-total_price') == -1)
                        {
                            if (ele.innerText == '')
                            {
                                flag = false;

                            }
                            else
                            {

                                if (colIdx == 1 && ele.className == 'editablegrid-material_number')
                                {
                                    console.log(newValue);
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = newValue;


                                    $.ajax({
                                        url: "/../admin/projectcostplan/materialdata/" + newValue,
                                        method: "POST",
                                        data: {'_token': token},
                                        dataType: "JSON "
                                    })
                                            .done(function (msg) {
                                                if ('status' in msg)
                                                {
                                                    if (msg.status != 'ok')
                                                    {
                                                        _$("message").innerHTML = "<p class='err'> Could not find  material data !.</p>";
                                                        return null;
                                                    }
                                                    else
                                                    {
                                                        _$("message").innerHTML = "";
                                                        row.querySelector('.editablegrid-description').innerText = msg.data.material_description;
                                                        row.querySelector('.editablegrid-unit_price').innerText = (isNaN(msg.data.standard_price) == false) ? parseFloat(msg.data.standard_price).toFixed(2) : '';
                                                        row.querySelector('.editablegrid-currency').innerText = 'USD' || msg.data.currency;
                                                        if (msg.data.currency == '') {
                                                            materialCostPlan.columns[8].editable = true;
                                                        }
                                                        if (row.querySelector('.editablegrid-quantity').innerText != '')
                                                        {
                                                            row.querySelector('.editablegrid-total_price').innerText = parseInt(row.querySelector('.editablegrid-quantity').innerText) * parseFloat(row.querySelector('.editablegrid-unit_price').innerText);
                                                            var length = $('td.editablegrid-total_price').length;
                                                            var total_ammount = 0;
                                                            $('td.editablegrid-total_price').each(function (ele, i) {
                                                                console.log(ele, i);
                                                                if (i < length - 1)
                                                                {
                                                                    total_ammount += parseInt(ele.innerText);
                                                                }
                                                            });
                                                            $('td.editablegrid-total_price').eq(length - 1).text(total_ammount);
                                                        }
                                                    }

                                                }
                                                else {
                                                    window.location.href = window.location.href;

                                                }

                                            });

                                }
                                else if (colIdx == 2 && ele.className == 'editablegrid-task')
                                {
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = newValue;
                                }
                                else if (colIdx == 4 && ele.className == 'editablegrid-quantity')
                                {
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = newValue;
                                    row.querySelector('.editablegrid-total_price').innerText = parseInt(row.querySelector('.editablegrid-quantity').innerText) * parseFloat(row.querySelector('.editablegrid-unit_price').innerText);
                                    var length = $('td.editablegrid-total_price').length;
                                    var total_ammount = 0;
                                    $('td.editablegrid-total_price').each(function (i, ele) {
                                        console.log(ele, i);
                                        if (i < length - 1)
                                        {
                                            console.log(ele.innerText);
                                            total_ammount += parseInt(ele.innerText);
                                        }
                                    });
                                    $('td.editablegrid-total_price').eq(length - 1).text(total_ammount);
                                }
                                else if (colIdx == 8 && ele.className == 'editablegrid-currency')
                                {
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = newValue;
                                    materialCostPlan.columns[8].editable = false;
                                }
                                else
                                    dataObj[ele.className.split('-')[1].replace(' nan', '')] = ele.innerText;
                            }

                        }
                    });
                    if (flag == true) {

                        add_cost('material', dataObj);
                        _$("message").innerHTML = "<p class='err'> added material data Successfully!!.</p>";

                        setTimeout(function () {

                            window.location.href = window.location.href;
                        }, 200);
                    } else {
                        console.log('material', dataObj);
                        _$("message").innerHTML = "<p class='err'>New value is '" + newValue + ", Updated Pending, Row Can't have empty fields </p>";
                    }
                }
            }


        }

    });


    materialCostPlan.setActions = function () {
        //_$("message").innerHTML = "<p class='ok'>Ready!</p>";
        this.setCellRenderer("action", new CellRenderer({render: function (cell, value) {

                if (value != 'blank')
                    var index = cell.rowIndex;
                var html = '';
                var id = materialCostPlan.getRowId(index).toString();
                if (id != '-1')
                {
                    if (id.indexOf('add') == -1)
                    {
                        html = "delete_cost('material'," + id + ");setTimeout(function(){$('[name^=project_number]').trigger('change');},500);";
                    }
                    else {
                        html = "materialCostPlan.remove(" + cell.rowIndex + ")";
                    }
                    cell.innerHTML = "<a onclick=\"if (confirm('Are you sure you want to delete this record ? ')){ " + html + "}\" style=\"cursor:pointer\">" +
                            "<img src=\"/../vendors/editable-grid/delete.png\" border=\"0\" alt=\"delete\" title=\"delete\"/></a>";
                }
            }}));
        this.renderGrid("grid_cost", "testgrid");
    };



    materialCostPlan.editCell = function (rowIndex, columnIndex)
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
    materialCostPlan.load({"metadata": material_meta, "data": material_data});
    materialCostPlan.renderGrid("grid_cost", "testgrid");
    materialCostPlan.setActions();


})()//end of doc ready


