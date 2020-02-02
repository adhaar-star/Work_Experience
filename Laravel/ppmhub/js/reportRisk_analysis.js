$(document).ready(function () {
    var table = $("#DateTablePPMHUB").DataTable({
        processing: true,
        serverSide: true,
        bDestroy: true,
        ajax: 'riskanalysis-data',
    });
    $(".reportClass").submit(function (e) {
        if ($(".reportClass").valid()) {
            console.log('form data', $(this).serialize());
            var table = $("#DateTablePPMHUB").DataTable({
				"initComplete": function () {
				
					riskAnalysisChart($('#reportProject_from').val(),$('#reportProject_to').val())
				},
                processing: true,
                serverSide: true,
                bDestroy: true,
                ajax: {
                    url: 'riskanalysis-data?'+$(this).serialize(),
                },
                columns: [
                    {data: 'project_Id', name: 'project_Id'},
                    {data: 'project_name', name: 'project_name'},
                    {data: 'qual_risk_id', name: 'qual_risk_id'},
                    {data: 'risk_type', name: 'risk_type'},
                    {data: 'risk_score', name: 'risk_score'},
                    {data: 'risk_status', name: 'risk_status', searchable: false},
                ]
            });
        }
    });
});

function riskAnalysisChart(fromid,toid) { 
	$.ajax({url: "riskanalysisgraph-data",type:'GET', dataType: "json",data:{'reportProject_from':fromid,'reportProject_to':toid}, success: function(result){
			
			
			$.each( result.data, function( i, item ) {
				
				
				if(i == 'qualitative_data')
				{
			
					var options = {
						chart: {
							renderTo: 'qualitative_graph_container',
							type: 'column'
						},
						title: {
							text: 'Project Risk Score (Qualitative)'
						},
						xAxis: {
							categories: [],
							title: {
								text: 'Risk Score' 
							}
							
						},
						yAxis: {
							title: {
								text: '' 
							}
						},
						
						tooltip: {
							formatter: function() {
								return ''+
								this.series.name +'Risk Score :'+ this.y +' ';
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
					
					$.each(item, function( i, item ) {
						series.data.push(parseFloat(item.total_risk_score));
						options.xAxis.categories.push(item.project_Id);
					});
					options.series.push(series);
					var chart = new Highcharts.Chart(options);
				}
				if(i == 'quantitative_data')
				{
					
					
					var options = {
						chart: {
							renderTo: 'quantitative_graph_container',
							type: 'column'
						},
						title: {
							text: 'Project Risk Score (Quantitative)'
							},
						xAxis: {
							categories: [],
							title: {
								text: 'Risk Score' 
							}
							
						},
						yAxis: {
							title: {
								text: '' 
							}
						},
						
						tooltip: {
							formatter: function() {
								return ''+
								this.series.name +'Risk Score :'+ this.y +' ';
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
					
					
					$.each(item, function( i, item ) {
						series.data.push(parseFloat(item.total_risk_score));
						options.xAxis.categories.push(item.project_Id);
						
					});
					options.series.push(series);
					var chart = new Highcharts.Chart(options);
				}
				
			});
    }});

};