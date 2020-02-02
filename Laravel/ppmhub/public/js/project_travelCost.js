

//miscelanious cost table
travel_meta = [];
travel_meta.push({name: "project_number", label: "Project Number", datatype: "string", 'editable': false});
travel_meta.push({name: "task", label: "Task", datatype: "string", 'editable': true, 'values': tasks});
travel_meta.push({name: "travel_request_number", label: "Travel Request Number", datatype: "string", 'editable': true});
travel_meta.push({name: "type", label: "Type", datatype: "string", 'editable': true, 'values': {'Capex': 'Capex', 'Opex': 'Opex', }});
travel_meta.push({name: "total_price", label: "Total Price", datatype: "double", 'editable': true});
travel_meta.push({name: "currency", label: "Currency", datatype: "string",  'editable': true, 'values': {0:currency}});
travel_meta.push({name: "action", label: "Action", datatype: "html", 'editable': false});
travel_data = result || [];

travelCostPlan = new EditableGrid("travelCost", {
    enableSort: false,
    // called when some value has been modified: we display a message
    modelChanged: function (rowIdx, colIdx, oldValue, newValue, row) {
        if (row.id != 'travelCost_total_cost') { // ignore the last row

            if (row.id.indexOf('add') == -1) { //update cost 
                var elements = row.querySelectorAll('td');
                var id = row.id.split('_')[1];
                var dataObj = {};
                var flag = true;
                $(elements).each(function (i, ele) {
                    if (ele.className !== 'editablegrid-action')
                    {

                        if (ele.innerText == '' && newValue == '')
                        {
                            flag = false;
                        } else
                        {

                            if (colIdx == 1 && ele.className == 'editablegrid-task')
                            {
                                dataObj[ele.className.split('-')[1].replace(' nan', '')] = newValue;
                            } else
                                dataObj[ele.className.split('-')[1].replace(' nan', '')] = ele.innerText;
                        }

                    }
                });

                if (flag == true) {

                    //console.log('material', dataObj, id);
                    update_cost('travel', dataObj, id);
                    _$("message").innerHTML = "<p class='ok'>New value is  '" + newValue + "', Updated successfully </p>";

                    setTimeout(function () {
                        window.location.href = window.location.href;
                        console.log(_$('message2'));
                    }, 100);

                } else
                {
                    console.log('travel', dataObj, id);

                    _$("message").innerHTML = "<p class='err'>New value is '" + newValue + "', Updated Pending, Row Can't have empty fields </p>";
                    window.location.href = window.location.href;
                }

            } else { // add cost

                var elements = row.querySelectorAll('td');
                var dataObj = {};
                var flag = true;
                $(elements).each(function (i, ele) {
                    if (ele.className !== 'editablegrid-action')
                    {
                        if (ele.innerText == '')
                        {
                            flag = false;

                        } else
                        {

                            if (colIdx == 1 && ele.className == 'editablegrid-task')
                            {
                                dataObj[ele.className.split('-')[1].replace(' nan', '')] = newValue;
                            } else
                                dataObj[ele.className.split('-')[1].replace(' nan', '')] = ele.innerText;
                        }

                    }
                });
                if (flag == true) {

                    add_cost('travel', dataObj);
                    _$("message").innerHTML = "<p class='ok'>New value is  '" + newValue + "', Added successfully </p>";

                    setTimeout(function () {
                        $('[name^=project_number]').trigger('change');
                        window.location.href = window.location.href;
                    }, 200);
                } else {
                    console.log('travel', dataObj);
                    _$("message").innerHTML = "<p class='err'>New value is '" + newValue + ", Updated Pending, Row Can't have empty fields </p>";
                }
            }
        }


    }

});


travelCostPlan.setActions = function () {
    this.setCellRenderer("action", new CellRenderer({render: function (cell, value) {

            if (value != 'blank')
                var index = cell.rowIndex;
            var html = '';
            var id = travelCostPlan.getRowId(index).toString();
            if (id != '-1')
            {
                if (id.indexOf('add') == -1)
                {
                    html = "delete_cost('travel'," + id + ");";
                } else {
                    html = "travelCostPlan.remove(" + cell.rowIndex + ")";
                }
                cell.innerHTML = "<a onclick=\"if (confirm('Are you sure you want to delete this record ? ')){ " + html + "}\" style=\"cursor:pointer\">" +
                        "<img src=\"/../vendors/editable-grid/delete.png\" border=\"0\" alt=\"delete\" title=\"delete\"/></a>";
            }
        }}));
    this.renderGrid("grid_cost", "testgrid");
};

travelCostPlan.editCell = function (rowIndex, columnIndex)
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

(function () {
    travelCostPlan.load({"metadata": travel_meta, "data": travel_data});
    travelCostPlan.renderGrid("grid_cost", "testgrid");
    travelCostPlan.setActions();
})();

