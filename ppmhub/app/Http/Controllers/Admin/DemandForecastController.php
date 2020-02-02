<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Project;
use App\cost_forecasting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Carbon;
use Illuminate\Http\JsonResponse;
use App\User;
use App\Roleauth;
use DateTime;
use DateInterval;
use DatePeriod;
use App\project_material_cost;
use App\project_miscellanous_cost;
use App\project_hardware_cost;
use App\project_software_cost;
use App\project_travel_cost;
use App\project_contingency_cost;
use App\project_facilities_cost;
use App\project_service_cost;
use App\project_internal_cost;
use App\project_external_cost;
use App\project_gr_cost;
use App\Helpers\ProjectHelpers;
use App\Models\Projects\ProjectCost;
use Yajra\DataTables\Facades\DataTables;
use App\demand_forecasting;
use App\Helpers\RoleAuthHelper;

class DemandForecastController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    return view('admin.demand_forecast.index', compact(''));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    $project_id = Project::where('company_id', '=', Auth::user()->company_id)->whereRaw('end_date is not NULL')->pluck('project_Id', 'id');
    $projectId = 0;
    return view('admin.demand_forecast.create', compact('project_id', 'projectId'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $id) {
    $post = Input::all();
    $demandForcast = array();

    foreach ($post['data'] as $key => $val) {
      $demandForcast[ucfirst($key)] = $val;
    }

    $demandForcastArr = array(
        'project_id' => $id,
        'forecast' => json_encode($demandForcast),
        'company_id' => Auth::user()->company_id,
        'changed_by' => Auth::user()->id,
        'plan_cost' => '1000',
        'start_date' => $post['startDate'],
        'end_date' => $post['endDate'],
        'forecast_total' => 0
    );

    $demandModel = demand_forecasting::Where('project_id', $id)->first();
    if ($demandModel) {
      unset($demandForcastArr['project_id']);
      $demandModel->update($demandForcastArr);
      return response()->json(['status' => true, 'msg' => 'Record Updated Successfully']);
    } else {
      demand_forecasting::create($demandForcastArr);
      return response()->json(['status' => true, 'msg' => 'Record Inserted Successfully']);
    }
//        return response()->json(['status' => true]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    $project = DB::table('project')->select('*')->where('id', $id)->first();
    $projectid = $project->project_Id;
    $startdate = $project->start_date;
    $enddate = $project->end_date;

    $sDate = date("m/y", strtotime($startdate));
    $eDate = date("m/y", strtotime($enddate));

    $periodData = $forecastYear = [];
    $start = (new DateTime($startdate))->modify('first day of this month');
    $end = (new DateTime($enddate))->modify('first day of next month');
    $interval = DateInterval::createFromDateString('1 month');
    $period = new DatePeriod($start, $interval, $end);

    $plan_cost = ProjectHelpers::get_project_planned_cost($projectid);
    $forcast = array();
    $forcast = demand_forecasting::where('company_id', Auth::user()->company_id)->where('project_id', $id)->select('forecast')->first();
    $fcObj = new \stdClass();
    $fcObj = isset($forcast->forecast) ? json_decode($forcast->forecast) : [];
    foreach ($period as $key => $dt) {
      $periodData[] = $dt->format("m/y");
      $forecastYear[$dt->format("M_Y")] = 0;
    }
    if (isset($forcast) && count($forcast) > 0) {
      foreach ($forecastYear as $key => $fcy) {
        if (property_exists($forcast->forecast, $key)) {
          $forecastYear[$key] = $forcast->forecast->$key;
        }
      }
      $forcast = $forcast->forecast;
    }

    $forcast = json_decode(trim($forcast, "'"), true);
    if (count($forecastYear) > 0 && isset($forcast)) {
      foreach ($forecastYear as $key => $val) {
        if (property_exists($fcObj, $key)) {
          $forecastYear[$key] = intval($fcObj->$key);
        }
      }
    }
    // Get Timesheet hours 
    $time_sheet_hours = ProjectCost::query()
        ->select('project_id', DB::raw('sum(TIME_TO_SEC(total_time)) as total_time_d'), DB::raw('sum(total_cost) as timesheet_cost'), DB::raw('DATE_FORMAT(created_at, "%b_%Y") as postingdate'))
        ->where('project_id', $id)
        ->groupBy('project_id', 'postingdate')
        ->get()->toArray();


    $actual = [];
    foreach ($time_sheet_hours as $pKey => $pVal) {
      if (array_key_exists($pVal['postingdate'], $forecastYear))
//                $actual[$pVal['postingdate']] = gmdate("H",$pVal['total_time_d']);
        $actual[$pVal['postingdate']] = gmdate("H", $pVal['total_time_d']);
    }

    // Calculate difference of Forecast and Actual
    $date = new DateTime();
    $curr_month = $date->format('M_Y');
    $difference = [];
    if (isset($forcast)) {
      $difference = project_gr_cost::calculateDifference($forcast, $actual);
    }
    //End
    $result = [];
    $result['cost_forecast'] = [
        'id' => 1, 'values' => ['period' => $periodData, 'forecast' => $forcast, 'actual' => $actual, 'difference' => $difference, 'plancost' => $plan_cost, 'forcastYear' => $forecastYear]
    ];
    return response()->json($result);
  }

  /**
   * Adjust cost forecast value
   */
  public function adjust($id) {
    $allData = $this->show($id);
    $data = json_decode(json_encode($allData->getData()), true);

    $costForecast = $data['cost_forecast']['values'];
    $forecastYear = $costForecast['forcastYear'];
    $actual = $costForecast['actual'];
    $forcast = $costForecast['forecast'];
    $difference = $costForecast['difference'];
    $periodData = $costForecast['period'];
    $plan_cost = $costForecast['plancost'];

    //Carry farward difference to next month and equal forecast and actual value
    $count = 1;
    $currentDate = new \DateTime();
    $currentMonthKey = new \DateTime();
    $currentMonthKey = $currentMonthKey->format('M_Y');
    foreach ($forecastYear as $fcKey => $fcVal) {
      $currentMonth = datetime::createfromformat('M_Y', $fcKey);
      if ($currentMonth < $currentDate) {
        $curDiff = 0;
        if (isset($forcast)) {
          //Set current actual value to current month forecast
          if (array_key_exists($fcKey, $actual)) {
            $curDiff = $fcVal - $actual[$fcKey];
            $forecastYear[$fcKey] = $actual[$fcKey];
          }

          if (array_key_exists($fcKey, $forcast) && array_key_exists($fcKey, $actual)) {
            $forcast[$fcKey] = $actual[$fcKey];
          }
          if (array_key_exists($currentMonthKey, $forcast)) {
            $forcast[$currentMonthKey] = $forcast[$currentMonthKey] + $curDiff;
          }
          //End
          //Set current difference 0 because we have set actual value to forecast
          $difference[$fcKey] = 0;
          if (array_key_exists($currentMonthKey, $difference) && array_key_exists($currentMonthKey, $actual) && array_key_exists($currentMonthKey, $forcast)) {
            $difference[$currentMonthKey] = $actual[$currentMonthKey] - $forcast[$currentMonthKey];
          }
        }
      }
    }
    $result = [];
    $result['cost_forecast'] = [
        'id' => 1, 'values' => ['period' => $periodData, 'forecast' => $forcast, 'actual' => $actual, 'difference' => $difference, 'plancost' => $plan_cost, 'forcastYear' => $forecastYear]
    ];
    return response()->json($result);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $project_id = Project::pluck('project_Id', 'id');
    $projectId = $id;
    return view('admin.demand_forecast.create', compact('project_id', 'projectId'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    $findCost = demand_forecasting::find($id);
    if ($findCost) {
      $findCost->delete();
    }
    return response()->json(['status' => 'msg', 'data' => 'Demand Forecast deleted successfully...']);
  }

  //project data for dropdown
  public function projectData($id) {
    $projectData = DB::table('project')->select('project_name', 'project_desc', 'start_date', 'end_date')->where('id', $id)->first();
    return response()->json($projectData);
  }

  public function data_table() {
    Roleauth::check('budget.original.index');

    $returnProject = DB::table('project')
      ->where('project.company_id', Auth::user()->company_id)
      ->select('project.project_Id as pid', 'project.project_name', 'project.id', 'demand_forecasting.forecast as forecast', 'demand_forecasting.changed_by as changed_by', 'demand_forecasting.id as costId')
      ->join('demand_forecasting', 'project.id', '=', 'demand_forecasting.project_id')
      ->get();

    $time_sheet_hours = ProjectCost::query()
        ->select('project_id', DB::raw('sum(TIME_TO_SEC(total_time)) as total_time_d'), DB::raw('sum(total_cost) as timesheet_cost'), DB::raw('DATE_FORMAT(created_at, "%b_%Y") as postingdate'))
        ->groupBy('project_id', 'postingdate')
        ->get()->toArray();

    $actual = [];
    foreach ($time_sheet_hours as $pKey => $pVal) {
      if (isset($actual[$pVal['project_id']]))
        $actual[$pVal['project_id']] += gmdate("H", $pVal['total_time_d']);
      else {
        $actual[$pVal['project_id']] = gmdate("H", $pVal['total_time_d']);
      }
    }
    foreach ($returnProject as $rKey => $costproject) {
      $name = '';
      if (isset($costproject->changed_by)) {
        $user = User::find($costproject->changed_by);
        $name = isset($user->name) ? $user->name : '-';
      }
      $costproject->changed_by = $name;
      $costproject->id = $costproject->id;

      $forecast = json_decode(json_encode(json_decode($costproject->forecast)), true);
      if (array_key_exists('Total', $forecast))
        unset($forecast['Total']);
      $returnProject[$rKey]->forecast = array_sum($forecast);
      if (array_key_exists($costproject->id, $actual)) {
        $returnProject[$rKey]->actual = $actual[$costproject->id];
      } else {
        $returnProject[$rKey]->actual = 0;
      }
      $returnProject[$rKey]->difference = ($returnProject[$rKey]->actual - $returnProject[$rKey]->forecast);
    }
    return DataTables::of($returnProject)
        ->editColumn('action', function ($returnProject) {
          $actionButton = (RoleAuthHelper::hasAccess('demandforecasting.view') != true) ? ' <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;"><i class="fa fa-eye" aria-hidden="true"></i>' :
            '<a class="btn btn-info btn-xs margin-right-1" id="modal_popup" data-toggle="modal" data-target="#table-pro-view-popup" data-id="' . $returnProject->costId . '"><i class="fa fa-eye" aria-hidden="true"></i> </a>';
          $actionButton .= (RoleAuthHelper::hasAccess('demandforecasting.update') != true) ? '<a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;"><i class="fa fa-pencil"></i>' :
            '<a href="/admin/costforcasting/' . $returnProject->id . '/edit" class="btn btn-info btn-xs margin-right-1"><i class="fa fa-pencil"></i></a>';
          $actionButton .= (RoleAuthHelper::hasAccess('demandforecasting.delete') != true) ? '<a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;"><i class="fa fa-trash"></i>' :
            '<a href="javascript:void(0);" id="del_row" data-id="' . $returnProject->costId . '" class="btn btn-danger btn-xs margin-right-1"><i class="fa fa-trash"></i></a>';
          return $actionButton;
        })
        ->rawColumns(['action'])
        ->make();
  }

  public function pop_upData() {
    $id = Input::get('id');
    $data = demand_forecasting::find($id);
    $forecast = json_decode(json_encode(json_decode($data->forecast)), true);
    if (array_key_exists('Total', $forecast))
      unset($forecast['Total']);
    $data->forecast_total = array_sum($forecast);

    $time_sheet_hours = ProjectCost::query()
      ->select('project_id', DB::raw('sum(TIME_TO_SEC(total_time)) as total_time_d'))
      ->where('project_id', $data->project_id)
      ->groupBy('project_id')
      ->get();
    if (isset($time_sheet_hours[0]->total_time_d)) {
      $data->actual_hours = floor($time_sheet_hours[0]->total_time_d / 3600);
    } else {
      $data->actual_hours = 0;
    }
    $data->difference = $data->actual_hours - $data->forecast_total;
    $data->project_name = ($data->project_id != '') ? Project::where('id', $data->project_id)->first()['original']['project_name'] : '';
    $data->project_Pid = ($data->project_id != '') ? Project::where('id', $data->project_id)->first()['original']['project_Id'] : '';
    return response()->json(array('data' => $data));
  }

}
