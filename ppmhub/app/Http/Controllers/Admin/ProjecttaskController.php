<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ProjectHelpers;
use App\Projecttask;
use App\Project;
use App\Projectphase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Personresponsible;
use App\Employee_records;
use App\Capacityunits;
use App\Roleauth;
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
use App\gr_ir;
use App\project_gr_cost;

class ProjecttaskController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    Roleauth::check('project.task.index');

    $projecttask = DB::table('tasks_subtask')
      ->select('tasks_subtask.*', 'project.project_Id', 'project_phase.phase_Id')
      ->leftJoin('project', 'tasks_subtask.project_id', '=', 'project.id')
      ->leftJoin('project_phase', 'tasks_subtask.phase_id', '=', 'project_phase.id')
      ->where('tasks_subtask.company_id', Auth::user()->company_id)
      ->get();


    //get login details
    $user = Auth::user();
    $username = DB::table('users')
        ->select('name')
        ->where('id', $user->id)->first();
    if (Auth::check()) {
      $user_name = $username->name;
    } else {
      $user_name = 'you are not logged in';
    }

    return view('admin.projecttask.index', compact('projecttask', 'user_name', 'subtask_id'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    Roleauth::check('project.task.create');

    $rand_number = substr(md5(microtime()), rand(0, 26), 3);


    //get login details
    $user = Auth::user();

    if (Auth::check()) {
      $username = $user->name;
    } else {
      $username = 'you are not logged in';
    }

    $project_id = DB::table("project")->where('company_id', Auth::user()->company_id)
      ->select('project_Id', DB::raw('concat(project_Id," ( ",project_desc," )") as name'))
      ->pluck('name', 'project_Id');



    $phase_id = DB::table("project_phase")
      ->select('phase_Id', DB::raw('concat(phase_Id, " ( ",phase_name," )") as name'))
      ->pluck('name', 'phase_Id');


    $tid = DB::table("tasks_subtask")->where('company_id', Auth::user()->company_id)
      ->select('task_Id', DB::raw('concat(" ( ",task_name," )") as name'))
      ->pluck('name', 'task_Id');

    $person = Employee_records::where('company_id', Auth::user()->company_id)
      ->select('employee_id', DB::raw('concat(employee_first_name," ",employee_middle_name," ",employee_last_name) as name'))
      ->pluck('name', 'employee_id');


    return view('admin.projecttask.create', compact('projecttask', 'username', 'person', 'project_id', 'phase_id', 'task_id', 'rand_number'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request            
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    Roleauth::check('project.task.create');

    $task_data = Input::all();
    $task_data['company_id'] = Auth::user()->company_id;
    $task_data['created_by'] = Auth::user()->id;


    $start_date = strtotime($task_data['start_date']);
    $end_date = strtotime($task_data['end_date']);
    if ($start_date > $end_date) {
      $msgs = ['start_date' => 'Start Date can`t be greater than End Date'];
      return redirect('admin/projecttask/create/')->withErrors($msgs)->withInput(Input::all());
    }
    $validationmessages = [
        'task_name.required' => 'Please enter task name',
        'task_type.required' => 'Please select task type',
        'project_id.required' => 'Please select project id',
        'phase_id.required' => 'Please select phase id',
        'start_date.required' => 'Please select start date',
        'end_date.required' => 'Please select end date',
        'status.required' => 'Please select status'
    ];

    $validator = Validator::make($task_data, [
          'task_name' => 'required',
          'task_type' => 'required',
          'project_id' => 'required',
          'project_id' => 'required',
          'phase_id' => 'required',
          'start_date' => 'required',
          'end_date' => 'required',
          'status' => 'required'
        ], $validationmessages);

    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('admin/projecttask/create')->withErrors($validator)->withInput(Input::all());
    }

    if (array_key_exists('sub_task_id', $task_data)) {
      $task = Projecttask::where('task_Id', $task_data['sub_task_id'])->first();
      if (isset($task) && $task != null)
        $task_data['parent_id'] = $task->id;
    }

    Projecttask::create($task_data);

    session()->flash('flash_message', 'Project task created successfully...');
    return redirect('admin/projecttask');
  }

  /**
   * Display the specified resource.
   *
   * @param int $id            
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id            
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    Roleauth::check('project.task.edit');
    $projecttask = Projecttask::find($id);
    if (!isset($projecttask)) {
      return redirect('admin/projecttask');
    }



    /**
     * Get project planned cost from cost planing modules
     */
    $materialCostData = project_material_cost::selectRaw('sum(unit_price * quantity) as total_price,currency')->groupBy('currency')->where('project_number', $projecttask->project_id)->where('task', $projecttask->task_Id . ' ( ' . $projecttask->task_name . ' )')->get()->toArray();

    $internalCostData = project_internal_cost::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projecttask->project_id)->where('task', $projecttask->task_Id . ' ( ' . $projecttask->task_name . ' )')->get()->toArray();

    $externalCostData = project_external_cost::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projecttask->project_id)->where('task', $projecttask->task_Id . ' ( ' . $projecttask->task_name . ' )')->get()->toArray();

    $serviceCostData = project_service_cost::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projecttask->project_id)->where('task', $projecttask->task_Id . ' ( ' . $projecttask->task_name . ' )')->get()->toArray();

    $softwareCostData = project_software_cost::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projecttask->project_id)->where('task', $projecttask->task_Id . ' ( ' . $projecttask->task_name . ' )')->get()->toArray();

    $hardwareCostData = project_hardware_cost::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projecttask->project_id)->where('task', $projecttask->task_Id . ' ( ' . $projecttask->task_name . ' )')->get()->toArray();

    $facilitiesCostData = project_facilities_cost::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projecttask->project_id)->where('task', $projecttask->task_Id . ' ( ' . $projecttask->task_name . ' )')->get()->toArray();

    $travelCostData = project_travel_cost::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projecttask->project_id)->where('task', $projecttask->task_Id . ' ( ' . $projecttask->task_name . ' )')->get()->toArray();

    $miscellaenousCostData = project_miscellanous_cost::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projecttask->project_id)->where('task', $projecttask->task_Id . ' ( ' . $projecttask->task_name . ' )')->get()->toArray();

    $contingencyCostData = project_contingency_cost::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projecttask->project_id)->where('task', $projecttask->task_Id . ' ( ' . $projecttask->task_name . ' )')->get()->toArray();

    $Net_Total = (float) (isset($materialCostData[0]['total_price']) ? $materialCostData[0]['total_price'] : 0);
    $Net_Total += (isset($internalCostData[0]['total_price']) ? $internalCostData[0]['total_price'] : 0); //internal
    $Net_Total += (isset($externalCostData[0]['total_price']) ? $externalCostData[0]['total_price'] : 0); //external
    $Net_Total += (isset($serviceCostData[0]['total_price']) ? $serviceCostData[0]['total_price'] : 0);
    $Net_Total += (isset($softwareCostData[0]['total_price']) ? $softwareCostData[0]['total_price'] : 0);
    $Net_Total += (isset($hardwareCostData[0]['total_price']) ? $hardwareCostData[0]['total_price'] : 0);
    $Net_Total += (isset($facilitiesCostData[0]['total_price']) ? $facilitiesCostData[0]['total_price'] : 0);
    $Net_Total += (isset($travelCostData[0]['total_price']) ? $travelCostData[0]['total_price'] : 0);
    $Net_Total += (isset($miscellaenousCostData[0]['total_price']) ? $miscellaenousCostData[0]['total_price'] : 0);
    $Net_Total += (isset($contingencyCostData[0]['total_price']) ? $contingencyCostData[0]['total_price'] : 0);

    /* End of Planned cost */


    /* Get Actual Cost from GR + time sheet value */

    $actual_cost = ProjectHelpers::get_actual_cost_task($id);


    // for person responsible person
    $responsible_person = Employee_records::select('employee_id', DB::raw('CONCAT(employee_id, " ( ",employee_first_name, " ", employee_middle_name, " ",employee_last_name, " )") AS emp_full_name'))
      ->where('company_id', Auth::user()->company_id)
      ->orderBy('employee_id')
      ->pluck('emp_full_name', 'employee_id');

    //$actual_cost = (count($actual_cost)>0)?$actual_cost->toArray()['actual_price']:0;
    $pid = DB::table('project')
      ->select('project.id')
      ->where('project_Id', $projecttask->project_id)
      ->first();
    $psid = $pid->id;

    $user = Auth::user();

    if (Auth::check()) {
      $username = $user->name;
    } else {
      $username = 'you are not logged in';
    }

    $capacity = array();
    $temp = Capacityunits::where('company_id', Auth::user()->company_id)->pluck('name', 'id');
    foreach ($temp as $key => $value) {
      $capacity[$key] = $value;
    }
    $person = array();
    $temp = Personresponsible::all();
    foreach ($temp as $key => $value) {
      $person[$value->id] = $value->name;
    }
    $requestedby = array();
    $temp = Employee_records::all();

    foreach ($temp as $value) {

      $requestedby[$value->employee_first_name] = isset($value->employee_first_name) ? $value->employee_first_name : '';
    }
    $project = DB::table('project')
      ->where('company_id', Auth::user()->company_id)
      ->get();

    $project_id = array();
    foreach ($project as $projectid) {

      $project_id[$projectid->project_Id] = $projectid->project_Id . ' ( ' . $projectid->project_name . ' )';
    }

    $phase = DB::table('project_phase')
      ->select('project_phase.*', 'project.project_Id')
      ->leftJoin('project', 'project_phase.project_id', '=', 'project.id')
      ->where('project_phase.project_id', $psid)
      ->get();

    $phase_id = array();
    foreach ($phase as $phaseid) {

      $phase_id[$phaseid->phase_Id] = $phaseid->phase_Id . ' ( ' . $phaseid->phase_name . ' )';
    }

    $task_id = array();
    $all_task = DB::table('tasks_subtask')
      ->select('tasks_subtask.task_Id', 'tasks_subtask.task_name')
      ->where('task_Id', '!=', $projecttask->task_Id)
      ->where('company_id', Auth::user()->company_id)
      ->get();

    foreach ($all_task as $task) {
      $task_id[$task->task_Id] = $task->task_Id . ' ( ' . $task->task_name . ' )';
    }
    
    $created_by = DB::table('users')
                ->select('users.name')
                ->where('id', $projecttask->created_by)
                ->where('company_id', Auth::user()->company_id)
                ->first();
    
    
    $changed_by = DB::table('users')
                ->select('users.name')
                ->where('id', $projecttask->modified_by)
                ->where('company_id', Auth::user()->company_id)
                ->first();
    
    return view('admin.projecttask.edit', compact('changed_by','created_by','Net_Total', 'actual_cost', 'capacity', 'username', 'requestedby', 'projecttask', 'person', 'project_id', 'phase_id', 'task_id', 'responsible_person'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request            
   * @param int $id            
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    Roleauth::check('project.task.edit');
    $projecttask = Projecttask::find($id);
    if (!isset($projecttask)) {
      return redirect('admin/projecttask');
    }

    $task_input = Input::all();

    $start_date = strtotime($task_input['start_date']);
    $end_date = strtotime($task_input['end_date']);
    if ($start_date > $end_date) {
      $msgs = ['start_date' => 'Start Date can`t be greater than End Date'];
      return redirect('admin/projecttask/' . $id . '/edit')->withErrors($msgs)->withInput(Input::all());
    }
    $validationmessages = [
        'task_name.required' => 'Please enter task name',
        'task_type.required' => 'Please select task type',
        'project_id.required' => 'Please select project id',
        'phase_id.required' => 'Please select phase id',
        'start_date.required' => 'Please select start date',
        'end_date.required' => 'Please select end date',
        'weighting_factor.required' => 'Please enter weighting factor',
        'weighting_factor.numeric' => 'Please select weighting factor numeric',
        'weighting_factor.between' => 'Please select weighting factor between 0 to 100',
        'completion.required' => 'Please enter completion',
        'completion.numeric' => 'Please select completion numeric',
        'completion.between' => 'Please select completion between 0 to 100',
    ];

    $validator = Validator::make($task_input, [
          'task_name' => 'required',
          'task_type' => 'required',
          'project_id' => 'required',
          'project_id' => 'required',
          'phase_id' => 'required',
          'start_date' => 'required',
          'end_date' => 'required',
          'weighting_factor' => 'required|numeric|between:0,100',
          'completion' => 'required|numeric|between:0,100'
        ], $validationmessages);

    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('admin/projecttask/' . $id . '/edit')->withErrors($validator)->withInput(Input::all());
    }
    $task = Projecttask::find($id);

    if (isset($task_input['sub_task_id'])) {
      if ($task->task_Id != $task_input['sub_task_id'] && !isEmptyOrNullString($task->task_Id)) {
        $task = Projecttask::where('task_Id', $task_input['sub_task_id'])->first();
        $task_input['parent_id'] = $task->id;
      } else {
        $task_input['parent_id'] = 0;
      }
    }
    Projecttask::find($id)->update($task_input);
    session()->flash('flash_message', 'Project task updated successfully...');
    return redirect('admin/projecttask');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id            
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    Roleauth::check('project.task.delete');
    $projecttask = Projecttask::find($id);
    if (!isset($projecttask)) {
      return redirect('admin/projecttask');
    }

    $projecttask->delete();
    session()->flash('flash_message', 'Project task deleted successfully...');
    return redirect('admin/projecttask');
  }

  public function getprojectname(Request $request) {


    $name = DB::table('project')->select('project_desc')->where('project_Id', $request->project_Id)->first();

    $projectId = Project::Where('project_Id', $request->project_Id)->first();
    $phase_data = DB::table("project_phase")
      ->select('id', 'phase_Id', 'phase_name')
      ->where('project_id', $projectId->id)
      ->get();

    $phaseArray = array();
    foreach ($phase_data as $phase) {

      $phaseArray[$phase->phase_Id] = $phase->phase_Id . ' ( ' . $phase->phase_name . ' )';
    }
    return response()->json(array('name' => $name, 'phase' => $phaseArray));
  }

  public function getphasename(Request $request) {
    $name = DB::table('project_phase')->select('phase_name')->where('phase_id', $request->phase_id)->first();
    $phase = Projectphase::Where('phase_id', $request->phase_id)->first();

    $task = DB::table("tasks_subtask")
      ->select('id', 'task_Id', 'task_name')
      ->where('phase_id', $phase->phase_Id)
      ->get();
    $task_id = array();
    foreach ($task as $taskid) {

      $task_id[$taskid->task_Id] = $taskid->task_Id . ' ( ' . $taskid->task_name . ' )';
    }
    return response()->json(array('name' => $name, 'task' => $task_id));
  }

  public function gettaskname(Request $request) {

    $name = DB::table('tasks_subtask')->select('task_name')->where('task_id', $request->task_id)->first();

    return response()->json($name);
  }

}
