$(document).ready(function () {
  
  $('option[value=""]').attr("disabled", "disabled"); //disabled first option to select
  $('#portfolio').change(function () {
    renderChart($(this).val());
  });

  function renderChart(portfolioId) {
    if (portfolioId) {
      $.ajax({
        url: "/admin/getportfolio-dashboard-chart-data/" + portfolioId,
        method: "GET",
        dataType: "JSON",
        success: function (response) {
          if (response.status) {
            $('#projectCount').html(response.data.projectCount); //Project counts
            //costs
            $('#plannedCost').html(response.data.plannedCost);
            $('#estimatedCost').html(response.data.estimatedCost);
            $('#percentBudget').html(response.data.percentBudget + ' %');
            $('#actualCost').html(response.data.actualCost == null ? 0 : response.data.actualCost);
            //Average values
            var estCost = response.data.estimatedCost != 0 ? (response.data.estimatedCost / response.data.projectCount).toFixed(2) : 0;
            var planCost = response.data.plannedCost != 0 ? (response.data.plannedCost / response.data.projectCount).toFixed(2) : 0;
            var actCost = response.data.actualCost != 0 ? (response.data.actualCost / response.data.projectCount).toFixed(2) : 0;
            $('#avgPlannedCost').html(planCost);
            $('#avgEstimatedCost').html(estCost);
            $('#avgActualCost').html(actCost);
            $('#planningProjectDuration').html(response.data.plannedDays);
            $('#avgActualPlanningCalendarDuration').html(response.data.actualCalDays);
            $('#avgActualPlanningManDays').html(response.data.actualWorkingDays);
            $('#avgPercentCompletePP').html(response.data.avgPhyProgress);
            $('#avgPercentCompleteCP').html(response.data.avgCostProgress);
            
            populateRAGTable(response.data.rag);
            renderProjectStatusChart(response.data.projectStatusChart);
            renderProjectCompletionChart(response.data.projectPercentChart);
            renderProjectPlannedCostChart(response.data.projectPlannedCostChart);
            renderProjectRedLightTrafficChart(response.data.redTrafficLight);
            drawProjectTrafficLights(response.data.projectTrafficLight);
          }
        }
      });
    }
  }
});

function drawProjectTrafficLights(data){
  var $rows = '';
  $.each(data, function(key,val){
     $rows += "<tr>"+
              "<td>"+val.projectName+"</td>"+
              "<td class='"+val.schedule+"'></td>"+
              "<td class='"+val.scope+"'></td>"+
              "<td class='"+val.quality+"'></td>"+
              "<td class='"+val.issue+"'></td>"+
              "<td class='"+val.risk+"'></td>"+
              "<td class='"+val.cost+"'></td>"+
            "</tr>";
  });
  $('#trafficlightsTable tr:not(:first)').remove();
  if($rows == ''){
    $rows = '<tr><td style="font-family:arial; width: 100%; text-align: center;" colspan="7">No data found</td><tr>';
  }
  console.log('$rows', $rows);
  $("#trafficlightsTable > tbody:first").after($rows);
}

function populateRAGTable(data){
  $.each(data, function(key, val){
    $('.'+ key +'Red').html(val.red);
    $('.'+ key+'Yellow').html(val.yellow);
    $('.'+ key+'Green').html(val.green);
  });
}
function renderProjectStatusChart(chartData){
  var projectStatusChartData = [{y: 0, name: "Active", color: "#006700"},{y: 0, name: "Inactive", color: "#ff0000"}];
  if(chartData.length > 0)
    projectStatusChartData = chartData;

  var projectStatusChart = new CanvasJS.Chart("projectStatusChart",
      {
        title: {
          fontFamily: "arial",
          text: "Project Status",
          fontSize: 20

        },
        animationEnabled: true,
        legend: {
          verticalAlign: "bottom",
          horizontalAlign: "center"
        },
        theme: "theme2",
        data: [
          {
            type: "pie",
            indexLabelFontFamily: "Garamond",
            indexLabelFontSize: 20,
            indexLabelFontWeight: "bold",
            startAngle: 0,
            indexLabelFontColor: "black",
            indexLabelLineColor: "darkgrey",
            indexLabelPlacement: "inside",
            toolTipContent: "{name}: {y}",
            showInLegend: true,
            indexLabel: "{y}",
            dataPoints: projectStatusChartData
          }
        ]

      });
  projectStatusChart.render();
}

function renderProjectCompletionChart(chartData) {
  var projectCompletionChart = new CanvasJS.Chart("projectCompletionChart",
      {
        title: {
          text: "Number of Projects by Percent Complete",
          fontSize: 20,
          fontFamily: "arial"
        },
        animationEnabled: true,
        legend: {
          verticalAlign: "center",
          horizontalAlign: "left",
          fontSize: 15,
          fontFamily: "Helvetica"
        },
        theme: "theme2",
        data: [
          {
            type: "pie",
            indexLabelFontFamily: "Garamond",
            indexLabelFontSize: 20,
            indexLabel: "",
            startAngle: 90,
            showInLegend: true,
            toolTipContent: "Projects in range  {legendText} is  {y}",
            dataPoints: [
                          {y: chartData.range75To100, legendText: "75-100", color: "#008e52", legendMarkerType: "square"},
                          {y: chartData.range50To75, legendText: "50-75", color: "#006700", legendMarkerType: "square"},
                          {y: chartData.range25To50, legendText: "25-50", color: "#6bf284", legendMarkerType: "square"},
                          {y: chartData.range0To25, legendText: "0-25", color: "#00ff00", legendMarkerType: "square"}
                        ]
          }
        ]
      });
  projectCompletionChart.render();
}

function renderProjectPlannedCostChart(chartData) {
  var projectPlannedCostChart = new CanvasJS.Chart("projectPlannedCostChart",
      {
        title: {
          text: "Number of Projects by Planned Cost",
          fontSize: 20,
          fontFamily: "arial"
        },
        animationEnabled: true,
        legend: {
          verticalAlign: "center",
          horizontalAlign: "left",
          fontSize: 17,
          fontFamily: "Helvetica"
        },
        theme: "theme2",
        data: [
          {
            type: "pie",
            indexLabelFontFamily: "Garamond",
            indexLabelFontSize: 20,
            startAngle: 100,
            showInLegend: true,
            indexLabelPlacement: "inside",
            indexLabel: "{y}",
            toolTipContent: "Projects which actual cost </br> is greater than planned cost",
            dataPoints: [ {y: chartData, legendText: "Planned Cost", color: "#218bf8", legendMarkerType: "square", indexLabelFontColor: "#000000"}]
          }
        ]
      });
  projectPlannedCostChart.render();
}

function renderProjectRedLightTrafficChart(chartData) {
  
  var projectRedLightTrafficChart = new CanvasJS.Chart("projectRedLightTrafficChart",
      {
        title: {
          text: "Number of Projects by Number of Red Traffic Lights",
          fontSize: 20,
          fontFamily: "arial"
        },
        legend: {
          verticalAlign: "center",
          horizontalAlign: "left",
          fontSize: 20,
          fontFamily: "Helvetica"
        },
        theme: "theme2",
        data: [
          {
            type: "pie",
            indexLabelFontFamily: "Garamond",
            indexLabelFontSize: 20,
            indexLabel: "",
            startAngle: -20,
            showInLegend: true,
            toolTipContent: "There are {y} projects </br>completed on time",
            dataPoints: [
              {y: chartData, legendText: "no red light", color: "#6bf284", legendMarkerType: "square"}
            ]
          }
        ]
      });
  projectRedLightTrafficChart.render();
}

window.onload = function () {
  renderProjectStatusChart(0, 0);
  renderProjectCompletionChart([]);
  renderProjectPlannedCostChart([])
  renderProjectRedLightTrafficChart(0);
  renderProjectPlannedCostChart(0);
}