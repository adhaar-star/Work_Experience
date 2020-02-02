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
					treeChart($('#reportProject_from').val(),$('#reportProject_to').val())
				},
			
                processing: true,
                serverSide: true,
                bDestroy: true,
                ajax: {
					
				
                    url: 'timesheetreport-data?' + $(this).serialize(),
                },
                columns: [
                    {data: 'PID', name: 'PID'},
                    {data: 'project_desc', name: 'project_desc'},
                    {data: 'planned_cost', name: 'planned_cost'},
                    {data: 'actual_cost', name: 'actual_cost'},
                    {data: 'overall_budget', name: 'overall_budget'},
                    {data: 'available_budget', name: 'available_budget', searchable: false},
                    {data: 'resource_cost', name: 'resource_cost', searchable: false},
                    {data: 'total_time', name: 'total_time', searchable: false},
                    {data: 'perc_total_cost', name: 'perc_total_cost', searchable: false},
                ]
            });
        }
    });
});

function treeChart(fromid,toid) {
	$.ajax({url: "timesheetgraph-data",type:'GET', dataType: "json",data:{'fromid':fromid,'toid':toid}, success: function(result){
	
			
			var options = {
				chart: {
					renderTo: 'graph_container',
					type: 'column'
				},
				title: {
					text: ''
				},
				xAxis: {
					categories: []
				},
				yAxis: {
					title: {
						text: ''
					}
				},
				
				tooltip: {
					formatter: function() {
						return ''+
						this.series.name +'% of Actual cost :'+ this.y +' ';
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
				series.data.push(parseFloat(item.perc_total_cost));
				options.xAxis.categories.push(item.PID);
				
			});
			options.series.push(series);
			var chart = new Highcharts.Chart(options);
    }});

};