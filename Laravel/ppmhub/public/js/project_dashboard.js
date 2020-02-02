$(document).ready(function () {
  $('option[value=""]').attr("disabled", "disabled"); //disabled first option to select
  $('#project').change(function () {
    renderChart($(this).val());
  });

  function renderChart(projectId) {
    if(projectId){
      $.ajax({
        url: "/admin/getproject-dashboard-chart-data/" + projectId,
        method: "GET",
        dataType: "JSON",
        success: function (response) {
          if (response.status) {
            $('#projectCommentary').html(response.projCommentary);
            $('#overallStatus').attr('class', response.overallStatus == true ? 'green' : 'red');
            renderDecisionChart(response.data.dapChart); //Set decision action chart data
            renderIssueChart(response.data.issueChart); //Set issue chart data
            renderRiskChart(response.data.riskChart); //Set risk chart data
            renderTaskChart(response.data.taskChart); //Set Task chart data
            renderBudgetChart(response.data.budgetData); //Set Budget chart actual and planned cost data
            renderTaskScheduleChart(response.data.taskSchedule);
          } else {
            alert("Please select project");
          }
        }
      });
    }else{
      alert("Please select project");
    }
  }
});

window.onload = function () {
  renderTaskChart(0, 0);
  renderDecisionChart([]);
  renderIssueChart([]);
  renderRiskChart([]);
  renderBudgetChart([]);
  renderTaskScheduleChart([]);
}

function formatTaskScheduleChartData(data) {
  var tasks = [];
  $.each(data, function (key, val) {
    tasks.push([val.id.toString(), val.task_name, new Date(val.start_date), new Date(val.end_date), null, parseInt(val.completion), null]);
  });
  return tasks;
}
function renderTaskScheduleChart(chartData) {
  google.charts.load('current', {'packages': ['gantt']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Task ID');
    data.addColumn('string', 'Task Name');
    data.addColumn('date', 'Start Date');
    data.addColumn('date', 'End Date');
    data.addColumn('number', 'Duration');
    data.addColumn('number', 'Percent Complete');
    data.addColumn('string', 'Dependencies');
    var taskScheduleChartData = [];
    var chart = new google.visualization.Gantt(document.getElementById('taskScheduleChartContainer'));
    if (chartData.length > 0) {
      taskScheduleChartData = formatTaskScheduleChartData(chartData);
      data.addRows(taskScheduleChartData);
      var heightAuto = data.getNumberOfRows() * 30 + 50;
      var options = {
        height: heightAuto,
        gantt: {
          trackHeight: 30
        }
      };
      chart.draw(data, options);
    } else {
      chart.clearChart();
      $('#taskScheduleChartContainer').html('');
    }
  }
}

function renderRiskChart(chartData) {
  var riskChartData = [
    {y: 0, indexLabel: "Green", legendText: "Low", color: "#05b050"},
    {y: 0, indexLabel: "Red", legendText: "High", color: "#ff0000"},
    {y: 0, indexLabel: "Yellow", legendText: "Medium", color: "#ffc003"}
  ];
  if (chartData.length > 0)
    riskChartData = chartData;
  var riskChart = new CanvasJS.Chart("riskChartContainer",
      {
        title: {
        },
        animationEnabled: true,
        data: [
          {
            type: "doughnut",
            startAngle: 60,
            toolTipContent: "",
            showInLegend: true,
            dataPoints: riskChartData
          }
        ]
      });
  riskChart.render();
}

function renderIssueChart(chartData) {
  var issueChartData = [
    {y: 0, indexLabel: "Normal", legendText: "Normal", color: "#b0bcde"},
    {y: 0, indexLabel: "Medium", legendText: "Medium", color: "#00bfff"},
    {y: 0, indexLabel: "Urgent", legendText: "Urgent", color: "#7990ce"},
    {y: 0, indexLabel: "Very Urgent", legendText: "Very Urgent", color: "#0080ff"},
    {y: 0, indexLabel: "Critical", legendText: "Critical", color: "#0040ff"},
  ];
  if (chartData.length > 0)
    issueChartData = chartData;
  var issueChart = new CanvasJS.Chart("issueChartContainer",
      {
        title: {
          text: "Issues"
        },
        animationEnabled: true,
        data: [
          {
            type: "doughnut",
            startAngle: 50,
            indexLabel: "Issue Chart",
            showInLegend: true,
//                        dataPoints: issueChartData
            dataPoints: issueChartData
          }
        ]
      });
  issueChart.render();
}

function renderDecisionChart(chartData) {
  var dapChartData = [
    {y: 0, label: 'Actions', legendText: 'Actions'},
    {y: 0, label: 'Change request', legendText: 'Change request'},
    {y: 0, label: 'Decision', legendText: 'Decision'}
  ];
  if (chartData.length > 0)
    dapChartData = chartData;
  var decisionChart = new CanvasJS.Chart("decisionActionPendingChartContainer", {
    animationEnabled: true,
    theme: "theme2",
//        showInLegend: true,
    title: {},
    data: [
      {
        legendText: "Decision/Action/Pending",
        type: "column", //change type to bar, line, area, pie, etc
        showInLegend: false,
        dataPoints: dapChartData
      }
    ]
  });
  decisionChart.render();
}
function renderTaskChart(chartData) {
  var taskChart = new CanvasJS.Chart("taskChart",
      {
        title: {
          text: 'Tasks',
          fontSize: 20,
          verticalAlign: "top", // "top", "center", "bottom"
          horizontalAlign: "center" // "left", "right", "center"
        },
        animationEnabled: true,
        legend: {
          verticalAlign: "bottom",
          horizontalAlign: "center"
        },
        theme: "theme1",
        data: [
          {
            type: "pie",
            indexLabelFontFamily: "Garamond",
            indexLabelFontSize: 20,
            startAngle: 120,
            indexLabelFontWeight: "bold",
            startAngle:0,
                indexLabelFontColor: "MistyRose",
            indexLabelLineColor: "darkgrey",
            indexLabelPlacement: "inside",
            toolTipContent: "{name}: {y}",
            showInLegend: true,
            indexLabel: "",
            dataPoints: [
              {y: chartData.taskOnTrack, name: "On Track", color: "#06b050"},
              {y: chartData.taskDelayed, name: "Delayed", color: "#ff0202"},
              {y: chartData.taskNotStarted, name: "Not Started", color: "#ffc003"}
            ]
          }
        ]

      });
  taskChart.render();
}
function formatBudgetChartData(data) {
  var cost = [];
  $.each(data, function (key, val) {
    cost.push({
      x: new Date(val.date),
      y: parseFloat(val.cost)
    });
  });
  return cost;
}

function renderBudgetChart(chartData) {
  var plannedCost = [{}];
  var actualCost = [{}];
  if (chartData.plannedCost && chartData.plannedCost.length > 0) {
    plannedCost = formatBudgetChartData(chartData.plannedCost);
  }
  if (chartData.actualCost && chartData.actualCost.length > 0) {
    actualCost = formatBudgetChartData(chartData.actualCost);
  }
  var budgetChart = new CanvasJS.Chart("budgetCostChartContainer",
      {
        title: {},
        animationEnabled: true,
        axisX: {
          gridColor: "Silver",
          tickColor: "silver",
          valueFormatString: "MMM-DD"
        },
        toolTip: {
          shared: true
        },
        theme: "theme2",
        axisY: {
          gridColor: "Silver",
          tickColor: "silver"
        },
        legend: {
          verticalAlign: "center",
          horizontalAlign: "right"
        },
        data: [
          {
            type: "line",
            showInLegend: true,
            lineThickness: 2,
            name: "Actual Cost",
            markerType: "",
            color: "#F08080",
            dataPoints: plannedCost
          },
          {
            type: "line",
            showInLegend: true,
            name: "Planned Cost",
            markerType: "",
            color: "#20B2AA",
            lineThickness: 2,
            dataPoints: actualCost
          }


        ],
        legend:{
          cursor: "pointer",
          itemclick: function (e) {
            if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
              e.dataSeries.visible = false;
            }
            else {
              e.dataSeries.visible = true;
            }
            chart.render();
          }
        }
      });
  budgetChart.render();
}



