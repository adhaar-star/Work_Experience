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
data.push({id: 1, values: {'code': 'R-101', 'type': 'Revenue Product Sales', 'amount': 0, 'currency': ''}});
data.push({id: 2, values: {'code': 'R-102', 'type': 'Revenue Service Offering', 'amount': 0, 'currency': ''}});
data.push({id: 11, values: {'code': 'R-000', 'type': 'Total Amount', 'amount': 0, 'currency': ''}});

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
                          html = '/admin/projectrevenueplan/product-sales/';
                          break;
                   case 1:
                          html = '/admin/projectrevenueplan/service-offering/';
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
