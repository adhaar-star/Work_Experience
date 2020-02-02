@extends('layout.adminnewlayout')
@section('title','Dashboard')

@section('body')
{!! Html::script('/js/portfolio_dashboard.js') !!}
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<style>
  .red{
    padding: 0 8px;
    width: 10%;
    background: red;
    border-color: white
  }
  .yellow{
    padding: 0 8px;
    width: 10%;
    background: yellow;
  }
  .green{
    padding: 0 8px;
    width: 10%;
    background: green;
  }
  .white{
    padding: 0 8px;
    width: 10%;
    background: white;
  }
</style>
<!-- Dashboard -->
<div class="dashboard-container">

  <div class="row">
    <div class="col-xl-12">
      <div class="widget widget-six">

        <div class="widget-body">

          <div class="dasboard-sec">
            <div class="inner-dasboard">
              <div class="first_sec">
                <h3>Portfolio: {{ Form::select('portfolio', $portfolio, null, ['class' => 'portfolio', 'id' => 'portfolio', 'placeholder' => 'Select Portfolio']) }}</h3>
                <h4>{{date("d-M-Y")}}</h4>
                <div class="clear"></div>
              </div>
              <div class="second_sec">
                <h1>Portfolio Dashboard</h1>
              </div>
              <div class="third_sec">
                <div class="third_first">
                  <h4>Portflio Summary</h4>
                  <p class="number">Number Of Project: </p>
                  <p class="projectCount"><span id="projectCount">0</span></p>
                  <div class="clear"></div>
                  <h5>Costs</h5>
                  <table>
                    <tr class="fullwidgth">
                      <td>Planned Cost($)</td>
                      <td id="plannedCost">0</td>
                    </tr>
                    <tr class="fullwidgth">
                      <td>Estimated Cost($)</td>
                      <td id="estimatedCost">0</td>
                    </tr>	
                    <tr class="fullwidgth">
                      <td>Actual Cost($)</td>
                      <td id="actualCost">0</td>
                    </tr>
                    <tr class="fullwidgth">
                      <td>Percentage of Budget</td>
                      <td id="percentBudget">0%</td>
                    </tr>
                  </table>
                  <h5>Average Values</h5>
                  <table>
                    <tr class="fullwidgth">
                      <td>% Complete Physical Progress</td>
                      <td id="avgPercentCompletePP" style="width: 40px;">0</td>
                    </tr>
                    <tr class="fullwidgth">
                      <td>% Complete Cost Proportional Progress</td>
                      <td id="avgPercentCompleteCP" style="width: 40px;">0</td>
                    </tr>
                    <tr class="fullwidgth">
                      <td>Planning Project Duration(man-days)</td>
                      <td id="planningProjectDuration">0</td>
                    </tr>	
                    <tr class="fullwidgth">
                      <td>Actual Project Duration(man-days)</td>
                      <td id="avgActualPlanningManDays">0</td>
                    </tr>
                    <tr class="fullwidgth">
                      <td>Actual Project Duration(calendar-days)</td>
                      <td id="avgActualPlanningCalendarDuration">0</td>
                    </tr>
                    <tr class="fullwidgth">
                      <td>Planned cost($)</td>
                      <td id="avgPlannedCost">0</td>
                    </tr>
                    <tr class="fullwidgth">
                      <td>Estimated Cost($)</td>
                      <td id="avgEstimatedCost">0</td>
                    </tr>
                    <tr class="fullwidgth">
                      <td>Actual Cost($)</td>
                      <td id="avgActualCost">0</td>
                    </tr>
                  </table>
                </div>
                <div class="third_section">
                  <div id="projectStatusChart" style="height: 300px; width: 30%; float:left;"></div>
                  <div id="projectCompletionChart" style="height: 300px; width: 30%; float:left;"></div>
                  <div id="projectPlannedCostChart" style="height: 300px; width: 40%; float:right;"></div>
                  <div class="chartContainer11" style="width: 40%; float:left;">
                    <p style="width:60%; float:left; font-family:arial;">RAG</p>
                    <p style="width:40%; float:left; font-family:arial;">Number of Project</p>
                    <table>			
                      <tr>
                        <td style="width:60%; font-family:arial;">Schedule</td>
                        <!--<td style="width:10%; padding:0 8px;">0</td>-->
                        <td class="scheduleRed" style="width:10%; background:red; padding:0 8px;">0</td>
                        <td class="scheduleYellow" style="width:10%; background:yellow; padding:0 8px;">0</td>
                        <td class="scheduleGreen" style="width:10%; background:green; padding:0 8px;">0</td>
                      </tr>
                      <tr>
                        <td style="width:60%; font-family:arial;">Scope</td>
                        <!--<td style="width:10%; padding:0 8px;">1</td>-->
                        <td class="scopeRed" style="width:10%; background:red; padding:0 8px;">0</td>
                        <td class="scopeYellow" style="width:10%; background:yellow; padding:0 8px;">0</td>
                        <td class="scopeGreen" style="width:10%; background:green; padding:0 8px;">0</td>
                      </tr>
                      <tr>
                        <td style="width:60%; font-family:arial;">Quality</td>
                        <!--<td style="width:10%; padding:0 8px;">1</td>-->
                        <td class="qualityRed" style="width:10%; background:red; padding:0 8px;">0</td>
                        <td class="qualityYellow" style="width:10%; background:yellow; padding:0 8px;">0</td>
                        <td class="qualityGreen" style="width:10%; background:green; padding:0 8px;">0</td>
                      </tr>
                      <tr>
                        <td style="width:60%; font-family:arial;">Issue</td>
                        <!--<td style="width:10%; padding:0 8px;">0</td>-->
                        <td class="issueRed" style="width:10%; background:red; padding:0 8px;">0</td>
                        <td class="issueYellow" style="width:10%; background:yellow; padding:0 8px;">0</td>
                        <td class="issueGreen" style="width:10%; background:green; padding:0 8px;">0</td>
                      </tr>
                      <tr>
                        <td style="width:60%; font-family:arial;">Risk</td>
                        <!--<td style="width:10%; padding:0 8px;">0</td>-->
                        <td class="riskRed" style="width:10%; background:red; padding:0 8px;">0</td>
                        <td class="riskYellow" style="width:10%; background:yellow; padding:0 8px;">0</td>
                        <td class="riskGreen" style="width:10%; background:green; padding:0 8px;">0</td>
                      </tr>
                      <tr>
                        <td style="width:60%; font-family:arial;">Cost</td>
                        <!--<td style="width:10%; padding:0 8px;">0</td>-->
                        <td class="costRed" style="width:10%; background:red; padding:0 8px;">0</td>
                        <td class="costYellow" style="width:10%; background:yellow; padding:0 8px;">0</td>
                        <td class="costGreen" style="width:10%; background:green; padding:0 8px;">0</td>
                      </tr>
                    </table>
                  </div>

                  <div id="projectRedLightTrafficChart" style="height: 300px; width: 40%; float:right;"></div>
                  <div class="trafficlight" style=" width: 50%; float:left;">
                    <p style="font-family:arial;">Traffic Lights Detail info</p>
                    <table id="trafficlightsTable">
                      <!--<thead>-->
                          <tr>
                            <th style="font-family:arial;">Project Name</th>
                            <th style="font-family:arial;width: 10%">S</th>
                            <th style="font-family:arial;width: 10%">Sc</th>
                            <th style="font-family:arial;width: 10%">Q</th>
                            <th style="font-family:arial;width: 10%">I</th>
                            <th style="font-family:arial;width: 10%">R</th>
                            <th style="font-family:arial;width: 10%">C</th>
                        </tr>
                      <!--</thead>-->
                      <!--<tbody>-->
                        <tr>
                          <td style="font-family:arial; width: 100%; text-align: center;" colspan="7">No data found</td>
                        </tr>  
                      <!--</tbody>-->
                    </table>
                  </div></div>
                <div class="clear"></div>
              </div>	
            </div>
          </div>


        </div>
      </div>
    </div>

  </div>        
</div>

<!-- End Dashboard -->
@endsection
