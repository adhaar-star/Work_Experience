<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Project;
use App\TasksSubtask;
use Yajra\DataTables\Facades\DataTables;

class ReportTaskDetailsController extends Controller {

    /**
     * Task details report
     * @param Request $request
     * @return type
     */
    public function taskdetailreport(Request $request) {
      
    $projectlist = array();
    $project_data = Project::where('project.company_id', '=', Auth::user()->company_id)->get();
    foreach ($project_data as $key => $project) {
      $projectlist[$project->id] = $project->project_Id . ' ( ' . $project->project_name . ' )';
    }
    return view('admin.report.taskdetailreport', compact('projectlist', 'report', 'status', 'reportProject_from', 'reportProject_to'));
  }
  /**
   * Get task report data datatables
   * @param Request $request
   * @return type
  */
  public function taskdetailDataTable(Request $request){
    $reportProject_from = $request->reportProject_from;
    $reportProject_to = $request->reportProject_to;
    $report = TasksSubtask::taskDetailReport($reportProject_from, $reportProject_to);
    return DataTables::of($report)
                        ->editColumn('task_sub_status', function ($report) {
                            if ($report->task_sub_status == 'Created')
                                return '<img src="/vendors/common/img/green.png" />';
                            elseif ($report->task_sub_status == 'In Progress')
                                return '<img src="/vendors/common/img/red.png" />';
                            else
                                return 'Complete';
                        })
                        ->rawColumns(['task_sub_status'])
                        ->make();
    }

}
