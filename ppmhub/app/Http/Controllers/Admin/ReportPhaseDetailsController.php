<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Projectphase;
use App\Projectmilestone;
use App\TasksSubtask;
use PDF;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ReportPhaseDetailsController extends Controller {

  public function phasedetail(Request $request) {

    //get project
    $projectlist = array();
    $project_data = Project::where('project.company_id', '=', Auth::user()->company_id)->get();
    foreach ($project_data as $key => $project) {
      $projectlist[$project->id] = $project->project_Id . ' ( ' . $project->project_name . ' )';
    }

    //get phase
    $projectPhaseList = array();
    $projectPhase_data = Projectphase::all();
    foreach ($projectPhase_data as $key => $phaselist) {
      $projectPhaseList[$phaselist->phase_Id] = $phaselist->phase_Id;
    }

    return view('admin.report.phasedetail', compact('projectTaskList', 'projectPhaseList', 'projectMilestoneList', 'projectlist', 'report', 'cost_centre', 'department_name', 'bucket_name', 'bucket_id', 'phase_name', 'phase_id', 'portfolio_name', 'portfolio_id', 'project_desc', 'reportProject_to', 'reportProject_from'));
  }
  
  public function phasedetailDataTable(Request $request){
        $report = Projectphase::getPhaseDetails($request->reportProject_from, $request->reportProject_to, $request->project_phase_id);
        return DataTables::of($report)
                ->editColumn('status', function ($report) {
                      if($report->status == 'active')
                      return '<img src="/vendors/common/img/green.png" />';
                      else
                      return '<img src="/vendors/common/img/red.png" />';
                    })
                    ->rawColumns(['status', 'confirmed'])
                ->make();
  }

}
