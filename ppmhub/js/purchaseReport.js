$(document).ready(function () {
    var table = $("#DateTablePPMHUB").DataTable({
        processing: true,
        serverSide: true,
        bDestroy: true,
        ajax: 'purchaserequisition-data',
    });
    $(".reportClass").submit(function (e) {
        if ($(".reportClass").valid()) {
            console.log('form data', $(this).serialize());
            var table = $("#DateTablePPMHUB").DataTable({
			
				"initComplete": function () {
				
					purchaseRequisitionChart($('#reportProject_from').val(),$('#reportProject_to').val())
				},
			
			
                processing: true,
                serverSide: true,
                bDestroy: true,
                ajax: {
                    url: 'purchaserequisition-data?'+$(this).serialize(),
                },
                columns: [
                    {data: 'project_Id', name: 'project_Id'},
                    {data: 'project_desc', name: 'project_desc'},
                    {data: 'requisition_number', name: 'requisition_number'},
                    {data: 'item_no', name: 'item_no'},
                    {data: 'item_cost', name: 'item_cost'},
                    {data: 'responsible_person', name: 'responsible_person'},
                    {data: 'vendor_name', name: 'vendor_name'},
                    {data: 'delivery_date', name: 'delivery_date', searchable: false},
                    {data: 'approved_indicator', name: 'approved_indicator'},
                ]
            });
        }
    });
});


function purchaseRequisitionChart(fromid,toid) { 
	
	$.ajax({url: "purchaserequisitiongraph-data",type:'GET', dataType: "json",data:{'fromid':fromid,'toid':toid}, success: function(result){
	
			var project = "" ;
			var cost = "";
			var options = {
				chart: {
					renderTo: 'graph_container',
					type: 'column'
				},
				title: {
					text: ''
				},
				xAxis: {
					categories: [],
					
				},
				yAxis: {
					title: {
						text: '' 
					}
				},
				
				tooltip: {
					formatter: function() {
						return ''+
						this.series.name +'Purchase Requisition Cost :'+ this.y +' ';
					},
				},
				series: [],
				credits: {
					enabled: false
				},
				plotOptions: {column: {colorByPoint: true}}
			};
			
			var series = { 
			
							name: ' ',
							data: []
						};
			
			
		    $.each( result.data, function( i, item ) {
				series.data.push(parseFloat(item.total_cost));
				options.xAxis.categories.push(item.project_Id);
				
			});
			options.series.push(series);
			var chart = new Highcharts.Chart(options);
    }});
}	