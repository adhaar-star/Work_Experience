$(document).ready(function () {
    var table = $("#DateTablePPMHUB").DataTable({
        processing: true,
        serverSide: true,
        bDestroy: true,
        ajax: 'project-data',
    });
    $(".reportClass").submit(function (e) {
        if ($(".reportClass").valid()) {
            console.log('form data', $(this).serialize());
            var table = $("#DateTablePPMHUB").DataTable({
			
				"initComplete": function () {
					
					projectdefinationDetailChart($('#reportProject_from').val(),$('#reportProject_to').val())
				},
			
			
                processing: true,
                serverSide: true,
                bDestroy: true,
                ajax: {
                    url: 'project-data?'+$(this).serialize(),
                },
                columns: [
                    {data: 'project_Id', name: 'project_Id'},
                    {data: 'project_desc', name: 'project_desc'},
                    {data: 'portfolio_id', name: 'portfolio_id'},
                    {data: 'portfolio_name', name: 'portfolio_name'},
                    {data: 'bucket_id', name: 'bucket_id'},
                    {data: 'bucket_name', name: 'bucket_name'},
                    {data: 'cost_centre', name: 'cost_centre'},
                    {data: 'name', name: 'name'},
                    {data: 'department_name', name: 'department_name'},
                    {data: 'created_date', name: 'created_at', searchable: false},
                    {data: 'start_date', name: 'start_date', searchable: false},
                    {data: 'end_date', name: 'end_date', searchable: false},
                    {data: 'status', name: 'status', searchable: false},
                ]
            });
        }
    });
});

function projectdefinationDetailChart(fromid,toid) { 
	
	
	$.ajax({url: "projectdefinationgraph-data",type:'GET', dataType: "json",data:{'fromid':fromid,'toid':toid}, success: function(result){
	
			var options = {
				chart: {
					renderTo: 'graph_container',
					type: 'column'
				},
				legend: {
					enabled: false
				}
				,
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
				series: [],
				credits: {
					enabled: false
				},
				//plotOptions: {column: {colorByPoint: true}}
				 tooltip: {
					headerFormat: '<table>',
					pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
					footerFormat: '</table>',
					shared: true,
					useHTML: true
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0
					}
				},
				colors: ['#4771c5', '#ee7d31', '#a3a8a2']
				
			};
			
			var series = { 
			
							name:"",
							data: []
						};
		    $.each( result.data, function( i, item ) {
				if(i == 3)
				{
			
					projectIds = item.value;
					projectArray = projectIds.split(',');
					for (i = 0; i < projectArray.length; i++) {
						options.xAxis.categories.push(projectArray[i]);
					}
				}
				else
				{	
					options.series.push({
						name: item.name,
						data: item.value
					})
				}
				
			});
			options.series.push(series);
			var chart = new Highcharts.Chart(options);
    }});
};