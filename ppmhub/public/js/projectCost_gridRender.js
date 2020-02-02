/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//add file after global vars , material , tasks ..etc
project_meta = [];
project_meta.push({name: "code", label: "Code", datatype: "string", editable: false});
project_meta.push({name: "type", label: "Type", datatype: "string", editable: false});
project_meta.push({name: "amount", label: "Amount", datatype: "double", editable: false});
project_meta.push({name: "currency", label: "Currency", datatype: "string", editable: false});
data = [];
data.push({id: 1, values: {'code': 'Z-101', 'type': 'Material Cost', 'amount': 0, 'currency': ''}});
data.push({id: 2, values: {'code': 'Z-102', 'type': 'Labour Internal', 'amount': 0, 'currency': ''}});
data.push({id: 3, values: {'code': 'Z-103', 'type': 'Labour External', 'amount': 0, 'currency': ''}});
data.push({id: 4, values: {'code': 'Z-104', 'type': 'Services (Contractor)', 'amount': 0, 'currency': ''}});
data.push({id: 5, values: {'code': 'Z-105', 'type': 'Software', 'amount': 0, 'currency': ''}});
data.push({id: 6, values: {'code': 'Z-106', 'type': 'Hardware', 'amount': 0, 'currency': ''}});
data.push({id: 7, values: {'code': 'Z-107', 'type': 'Facilities', 'amount': 0, 'currency': ''}});
data.push({id: 8, values: {'code': 'Z-108', 'type': 'Travel', 'amount': 0, 'currency': ''}});
data.push({id: 9, values: {'code': 'Z-109', 'type': 'Miscellaenous', 'amount': 0, 'currency': ''}});
data.push({id: 10, values: {'code': 'Z-110', 'type': 'Contingency', 'amount': 0, 'currency': ''}});
data.push({id: 11, values: {'code': 'Z-000', 'type': 'Total Amount', 'amount': 0, 'currency': ''}});

(function() {
    projectCostPlan = new EditableGrid("projectCost");
    projectCostPlan.load({"metadata": project_meta, "data": data});
    projectCostPlan.renderGrid("project_cost", "testgrid");
    projectCostPlan.setActions = function () {

        this.setCellRenderer("action", new CellRenderer({render: function (cell, value) {
            var projectId = $('select[name^=project_number] :selected').val();
            var html='';
            if (cell.rowIndex!=undefined)
                switch(cell.rowIndex)
               {
                   case 0:
                          html = '/admin/projectcostplan/material/';
                          break;
                   case 1:
                          html = '/admin/projectcostplan/internal/';
                          break;
                   case 2:
                          html = '/admin/projectcostplan/external/';
                          break;
                   case 3:
                          html = '/admin/projectcostplan/service/';
                          break;
                   case 4:
                         html =  '/admin/projectcostplan/software/';
                          break;
                   case 5:
                          html = '/admin/projectcostplan/hardware/';
                          break;
                   case 6:
                          html = '/admin/projectcostplan/facilities/';
                          break;
                   case 7:
                          html = '/admin/projectcostplan/travel/';
                          break;
                   case 8:
                          html = '/admin/projectcostplan/miscellanous/';
                          break;
                   case 9:
                          html = '/admin/projectcostplan/contingency/';
                          break;
                      
               }
               
                if (cell.rowIndex != 10)
                    cell.innerHTML =    html = "<a href=\""+html+projectId+"\" style=\"padding-left:5px;cursor:pointer\">" +
                            "<img src=\"/../vendors/editable-grid/edit.png\" border=\"0\" alt=\"edit\" title=\"edit\"/ width=\"25\"/></a>" +
                            "<a onclick=\"\" href=\"javascript:void(0);\" style=\"padding-left:5px;cursor:pointer\">" +
                            "<img src=\"/../vendors/editable-grid/msg.png\" border=\"0\" alt=\"message\" title=\"message\"/ width=\"30\"/></a>";
            ;
            }}));
        this.renderGrid("project_cost", "testgrid");
    };
    project_meta.push({name: "action", label: "Action", datatype: "html", editable: false});
    /*--------------------------------------------------------------------------------------*/
})();
