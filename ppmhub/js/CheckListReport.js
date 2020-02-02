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
					checklistChart($('#reportProject_from').val(),$('#reportProject_to').val())
				},
                processing: true,
                serverSide: true,
                bDestroy: true,
                ajax: {
                    url: 'checklist-data?'+$(this).serialize(),
                },
                columns: [
                    {data: 'project_Id', name: 'project_Id'},
                    {data: 'project_desc', name: 'project_desc'},
                    {data: 'responsible_person', name: 'responsible_person'},
                    {data: 'checklist_id', name: 'checklist_id'},
                    {data: 'checklist_text', name: 'checklist_text'},
                    {data: 'checklist_status', name: 'checklist_status',searchable: false},
                    {data: 'created_on', name: 'created_on',searchable: false},
                ]
            });
        }
    });
});

function checklistChart(fromid,toid) { 
	//alert(fromid);
	//alert(toid);
	$.ajax({url: "checklist-graphdata",type:'GET', dataType: "json",data:{'reportProject_from':fromid,'reportProject_to':toid}, success: function(result){
			
			
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