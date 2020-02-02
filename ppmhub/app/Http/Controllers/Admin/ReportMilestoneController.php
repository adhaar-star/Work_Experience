<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Roleauth;
use App\Project;
use App\Projectmilestone;
use App\Projectphase;
use App\TasksSubtask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class ReportMilestoneController extends Controller {

  public function milestonereport(Request $request) {
    Roleauth::check('project.create');
        
    $reportProject_from = $request->reportProject_from;
    $reportProject_to = $request->reportProject_to;
    $project_phase_id = $request->project_phase_id;
    $project_task_id = $request->project_task_id;
    $project_milestone_Id = $request->project_milestone_Id;
    $request_p = $request->e;

    //get project
    $projectlist = array();
    $project_data = Project::where('project.company_id', '=', Auth::user()->company_id)->get();
    foreach ($project_data as $key => $project) {
      $projectlist[$project->id] = $project->project_Id . ' ( ' . $project->project_name . ' )';
    }

    //get milestone
    $projectMilestoneList = array();
    $projectMilestone_data = Projectmilestone::all();
    foreach ($projectMilestone_data as $key => $milestone) {
      $projectMilestoneList[$milestone->milestone_Id] = $milestone->milestone_Id;
    }

    //get phase
    $projectPhaseList = array();
    $projectPhase_data = Projectphase::all();
    foreach ($projectPhase_data as $key => $phaselist) {
      $projectPhaseList[$phaselist->id] = $phaselist->phase_Id;
    }

    //get task
    $projectTaskList = array();
    $taskSubtask_data = TasksSubtask::all();
    foreach ($taskSubtask_data as $key => $tasklist) {
      $projectTaskList[$tasklist->id] = $tasklist->task_Id;
    }
    return view('admin.report.milestonereport', compact('project_phase_id', 'projectTaskList', 'projectPhaseList', 'projectMilestoneList', 'projectlist', 'report', 'reportProject_from', 'reportProject_to', 'reportEnd_date', 'reportStart_date', 'project_task_id', 'project_milestone_Id', 'milestone_name', 'project_desc', 'request_p'));
  }

  public function export_milestone_html($reportProject_from = null, $reportProject_to = null, $project_phase_id = null, $project_task_id = null, $project_milestone_Id = null) {
    $query = array();
    if (isset($reportProject_from) && isset($reportProject_to)) {
      $query = Projectmilestone::mileStoneReport($reportProject_from, $reportProject_to, $project_phase_id, $project_task_id, $project_milestone_Id);
    }

    if (isset($reportProject_from))
      $from = "reportProject_from=$reportProject_from";
    else
      $from = "";
    if (isset($reportProject_to))
      $to = "reportProject_to=$reportProject_to";
    else
      $to = "";
    if (isset($project_phase_id))
      $phase_id = "project_phase_id=$project_phase_id";
    else
      $phase_id = "";
    if (isset($project_task_id))
      $task_id = "project_task_id=$project_task_id";
    else
      $task_id = "";
    if (isset($project_milestone_Id))
      $milestone_id = "project_milestone_Id=$project_milestone_Id";
    else
      $milestone_id = "";

    if (count($query) == 0) {
      return Redirect::to('admin/milestonereport?' . $from . '&' . $to . '&' . $phase_id . '&' . $task_id . '&' . $milestone_id . '&e=*h-');
    }

    $file = "Milestone.html";
    header("Content-type: application/vnd.html");
    header("Content-Disposition: attachment; filename=$file");
    echo '<div style="width:100%;float:left"><h2>Project Report: Milestone Report</h2></div>
		<table width="100%">
		<tr style="border:1px solid #ccc";>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Project ID</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Project Description</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Phase ID</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Task ID</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Milestone ID</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Milestone Description</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Scheduled Date</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Actual Date</b></th>
		</tr>';
    foreach ($query as $data) {

      if (isset($data->schedule_date)) {
        $phpdate = strtotime($data->schedule_date);
        $schedule_date = date('d/M/Y', $phpdate);
      } else {
        $schedule_date = "";
      }

      if (isset($data->actual_date)) {
        $phpdate = strtotime($data->actual_date);
        $actual_date = date('d/M/Y', $phpdate);
      } else {
        $actual_date = "";
      }
      echo '
        <tr style="border:1px solid #ccc";>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->project_Id . '</b></td>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->project_desc . '</b></td>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->phase_Id . '</b></td>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->task_Id . '</b></td>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->project_milestone_Id . '</b></td>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->milestone_name . '</b></td>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $schedule_date . '</b></td>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $actual_date . '</b></td>
        </tr>';
    }
    echo '</table>';
  }
  
  /**
   * Get milestone report data datatables
   * @param Request $request
   * @return type
   */
  public function mileStoneReportDatatable(Request $request){
    
    $reportProject_from = $request->reportProject_from;
    $reportProject_to = $request->reportProject_to;
    $project_phase_id = $request->project_phase_id;
    $project_task_id = $request->project_task_id;
    $project_milestone_Id = $request->project_milestone_Id;
    
    $report = Projectmilestone::mileStoneReport($reportProject_from, $reportProject_to, $project_phase_id, $project_task_id, $project_milestone_Id);
    
    return DataTables::of($report)->make();
  }
}
