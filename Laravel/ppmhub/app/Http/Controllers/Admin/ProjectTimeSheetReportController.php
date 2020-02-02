<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Project;
use Illuminate\Support\Facades\DB;
use App\Roleauth;
use App\Models\Projects\ProjectCost;
use App\Helpers\ProjectHelpers;
use Yajra\DataTables\Facades\DataTables;

class ProjectTimeSheetReportController extends Controller
{
    public function timesheetreport(Request $request) {

    $projectlist = array();
    $project_data = Project::all();
    foreach ($project_data as $key => $project) {
      $projectlist[$project->id] = $project->project_Id . ' ( ' . $project->project_name . ' )';
    }


    $query = ProjectCost::query();
    $query->select('project_costs.project_id as pcPid','project_costs.total_cost','project_costs.total_time','project.project_Id','project.id as pid','project.project_desc')
           ->leftJoin('project' , 'project.id','=','project_costs.project_id')
           ->orderBy('project_costs.project_Id');
    
    return view('admin.report.timesheet', compact('report', 'projectlist', 'reportProject_desc', 'reportProject_from', 'reportProject_to', 'reportEnd_date', 'reportStart_date', 'request_p'));
  }
  
  public function timesheetreportDataTable(Request $request) {
    $reportProject_from = $request->reportProject_from;
    $reportProject_to = $request->reportProject_to;
    
    $report = ProjectCost::timeSheetReportData($reportProject_from,$reportProject_to);
    foreach ($report as $key => $value) {
                $report[$key]->actual_cost = ProjectHelpers::get_actual_cost_project($value->project_id);
                $report[$key]->planned_cost = round(ProjectHelpers::get_project_planned_cost($value->PID, 2));
                $report[$key]->overall_budget = round(ProjectHelpers::get_project_overall_budget($value->project_id, 2));
                $report[$key]->available_budget = $report[$key]->overall_budget - $report[$key]->actual_cost;
                $report[$key]->perc_total_cost = round(($report[$key]->resource_cost/$report[$key]->actual_cost)*100,2);
    }
    return DataTables::of($report)
            ->editColumn('total_time', function ($report) {
                      return gmdate("H:i:s", $report->total_time);
                    })
            ->editColumn('perc_total_cost', function ($report) {
                      return $report->perc_total_cost.' %';
                    })
            ->editColumn('PID', function ($report) {
                      return '<a data-toggle="modal" id="modal_popup" data-target="#table-pro-view-popup" data-id="'.$report->project_id.'">'.$report->PID.'</a>';
                    })
            ->rawColumns(['PID'])
            ->make();
  }
  public function timesheetgraphDataTable(Request $request) {
		
		
		$reportProject_from = $request->fromid;
		$reportProject_to = $request->toid;
		$report = ProjectCost::timeSheetReportData($reportProject_from,$reportProject_to);
			  foreach ($report as $key => $value) {
                $report[$key]->actual_cost = ProjectHelpers::get_actual_cost_project($value->project_id);
                $report[$key]->planned_cost = round(ProjectHelpers::get_project_planned_cost($value->PID, 2));
                $report[$key]->overall_budget = round(ProjectHelpers::get_project_overall_budget($value->project_id, 2));
                $report[$key]->available_budget = $report[$key]->overall_budget - $report[$key]->actual_cost;
                $report[$key]->perc_total_cost = round(($report[$key]->resource_cost/$report[$key]->actual_cost)*100,2);
		}
		return DataTables::of($report)
            ->editColumn('total_time', function ($report) {
                      return gmdate("H:i:s", $report->total_time);
                    })
            ->editColumn('perc_total_cost', function ($report) {
                      return $report->perc_total_cost.' %';
                    })
            ->editColumn('PID', function ($report) {
                      return $report->PID;
                    })
            ->rawColumns(['PID'])
            ->make();
		
	}
  
  
}
