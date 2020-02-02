@extends('layout.adminnewlayout')
@section('title','Project | Dashboard')
@section('body')
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
{!! Html::script('/js/project_dashboard.js') !!}
<!-- Dashboard -->
<style>
  .green{
    background: green;
    border: 2px solid #000;
  }
</style>
<div class="dashboard-container">

  <div class="row">
    <div class="col-xl-12">
      <div class="widget widget-six">

        <div class="widget-body">

          <div class="cart_outer">
            <div class="cart_inner">
              <div class="cart_title">
                <ul>
                  <li class="projectname" style="padding:2px 50px;">Project Name</li>
                  <li class="projectx" style="padding:2px 50px;">
                    {{ Form::select('project', $projects, null, ['class' => 'project', 'id' => 'project', 'placeholder' => 'Select Project']) }}
                  </li>
                  <li class="statusdate" style="padding:2px 50px;">Status Date</li>
                  <li class="jul" style="padding:2px 55px;">{{date("d-M-Y")}}</li>
                  <li class="over" style="padding:2px 50px;">Overall status</li>
                  <li class="" id="overallStatus" style="padding:12px 90px;"></li>
                  <div class="clear"></div>
                </ul>

              </div>
              <div class="commnity">
                <p><span>Project Commentary - <span id="projectCommentary"></span></span></p>
              </div>
              <div class="top_shudlue">
                <h4>schedule</h4>
              </div>
              <div id="taskScheduleChartContainer" style="height: auto; width: 60%; float:left;"></div>
              <div id="taskChart" style="height: 300px; width: 39%; float:right;"></div>
              <div class="clear"></div>
              <div class="bottom_sec">
                <ul>
                  <li>Budget</li>
                  <li>Risks</li>
                  <li>Issues</li>
                  <li>Decision/Actions/Pending</li>
                  <div class="clear"></div>
                </ul>
                <div id="budgetCostChartContainer" style="height: 300px; width: 25%; float:left;"></div>
                <div id="riskChartContainer" style="height: 300px; width: 25%; float:left;"></div>
                <div id="issueChartContainer" style="height: 300px; width: 25%; float:left;"></div>
                <div id="decisionActionPendingChartContainer" style="height: 300px; width: 25%; float:right;"></div>
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
