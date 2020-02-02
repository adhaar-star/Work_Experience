/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function (){
    
    $(document).on('change','#projectId',function () {
        var project_id = $(this).val();        
        $('#projectId').val("0");
        $.ajax({
            url: "/admin/projectdata/" + project_id,
            method: "GET",
            dataType: "JSON",
            success: function (data) { 
                select_project(project_id);
                $('#project_description').val(data.project_desc);                
                $('#project_start_date').val(data.start_date);
                $('#project_end_date').val(data.end_date);
                makeColumns(data.start_date,data.end_date);
            }
        });
    });
    
});

function makeColumns(start,end){
  from = start;
    to = end;
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
            meta.push({name: "currency", label: "Currency", datatype: "string", 'editable': true, 'values': currency});
            meta.push({name: "action", label: "Action", datatype: "html", 'editable': false});
            costForecast.load({"metadata": meta, "data": external_data});
            costForecast.setActions();
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

//add file after global vars , material , tasks ..etc
meta = [];
meta.push({name: "period", label: "Period", datatype: "string", editable: false});
meta.push({name: "period", label: "01/17", datatype: "string", editable: false});
meta.push({name: "period", label: "02/17", datatype: "string", editable: false});
meta.push({name: "period", label: "03/17", datatype: "string", editable: false});
meta.push({name: "period", label: "04/17", datatype: "string", editable: false});
meta.push({name: "period", label: "05/17", datatype: "string", editable: false});
data = [];
data.push({id: 1, values: {'period':'','forecast':'','actual':'','difference':'','plancost':''}});

(function() {
    costForecast = new EditableGrid("cost_forecasting");
    costForecast.load({"metadata": meta, "data": data});
    costForecast.renderGrid("cost_forecast", "testgrid");
    costForecast.setActions = function () {

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
