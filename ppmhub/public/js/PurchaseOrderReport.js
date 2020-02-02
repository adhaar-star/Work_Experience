$(document).ready(function () {
    var table = $("#DateTablePPMHUB").DataTable({
        processing: true,
        serverSide: false,
        bDestroy: true
    });
    $(".reportClass").submit(function (e) {
        if ($(".reportClass").valid()) {
            console.log('form data', $(this).serialize());
            var table = $("#DateTablePPMHUB").DataTable({
			
				"initComplete": function () {
				
					purchaseOrderChart($('#reportProject_from').val(),$('#reportProject_to').val())
				},
			
                processing: true,
                serverSide: true,
                bDestroy: true,
                ajax: {
                    url: 'purchaseOrder-data?'+$(this).serialize(),
                },
                columns: [
                    {data: 'project_Id', name: 'project_Id'},
                    {data: 'project_desc', name: 'project_desc'},
                    {data: 'purchase_order_number', name: 'purchase_order_number'},
                    {data: 'item_no', name: 'item_no'},
                    {data: 'item_cost', name: 'item_cost'},
                    {data: 'responsible_person', name: 'responsible_person'},
                    {data: 'vendor_name', name: 'vendor_name'},
                    {data: 'delivery_date', name: 'delivery_date',searchable: false},
                    {data: 'status', name: 'status',searchable: false},
                ]
            });
        }
    });
});

function purchaseOrderChart(fromid,toid) { 
	$.ajax({url: "purchaseordergraph-data",type:'GET', dataType: "json",data:{'fromid':fromid,'toid':toid}, success: function(result){
	
			
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
						this.series.name +'Purchase Order Cost :'+ this.y +' ';
					},
				},
				series: [],
				credits: {
					enabled: false
				},
				plotOptions: {column: {colorByPoint: true}},
				colors: ['#4473c5','#ee7d31','#a5a5a5','#ffc000','#5a9bd5','#70ad46','#264478']
			};
			
			var series = { 
			
							name: ' ',
							data: []
						};
			
			
		    $.each( result.data, function( i, item ) {
				series.data.push(parseFloat(item.total_order_cost));
				options.xAxis.categories.push(item.vendor_id);
				
			});
			options.series.push(series);
			var chart = new Highcharts.Chart(options);
    }});

};