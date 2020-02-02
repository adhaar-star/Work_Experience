<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Projects\ProjectCost;
use App\Helpers\ProjectHelpers;


class ReportProjectDefinitionController extends Controller
{

    public function projectdefinitiondetail(Request $request)
    {
        //get project
        $projectlist = array();
        $project_data = Project::where('project.company_id', '=', Auth::user()->company_id)->get();
        foreach ($project_data as $key => $project) {
            $projectlist[$project->id] = $project->project_Id . ' ( ' . $project->project_name . ' )';
        }
        return view('admin.report.projectdefinitiondetail', compact('projectlist', 'report', 'cost_centre', 'department_name', 'bucket_name', 'bucket_id', 'portfolio_name', 'portfolio_id', 'name', 'project_desc', 'reportEnd_date', 'reportStart_date', 'reportProject_to', 'reportProject_from'));
    }
    
    /**
   * Get project report data datatables
   * @param Request $request
   * @return type
   */
  public function projectReportDatatable(Request $request){
    
    $reportProject_from = $request->reportProject_from;
    $reportProject_to = $request->reportProject_to;
    $reportStart_date = $request->reportStart_date;
    $reportEnd_date = $request->reportEnd_date;
    $report = Project::projectReport($reportProject_from, $reportProject_to, $reportStart_date, $reportEnd_date);
    return DataTables::of($report)
            ->editColumn('status', function ($report) {
                      if($report->status == 'active')
                      return '<img src="/vendors/common/img/green.png" />';
                      else
                      return '<img src="/vendors/common/img/red.png" />';
                    })
            ->rawColumns(['status'])
            ->make();
  }
  
  
  public function projectdefinationgraphDataTable(Request $request) {
		
		
		$reportProject_from = $request->fromid;
		$reportProject_to = $request->toid;
		$planned = array();
		$actual = array();
		$overall = array();
		$project = array();
		$result_array = array();
		
		
		$report = ProjectCost::timeSheetReportData($reportProject_from,$reportProject_to);
			
		 foreach ($report as $key => $value) {
				$planned[] = round(ProjectHelpers::get_project_planned_cost($value->PID, 2));
				$actual[] = ProjectHelpers::get_actual_cost_project($value->project_id);
				$budget[] = round(ProjectHelpers::get_project_overall_budget($value->project_id, 2));
				$project[] = $value->PID;
				
		}
		
		if(!empty($planned)){
			$result_array['data'][0]['name']='Planned cost' ;
			$result_array['data'][0]['value']=$planned ;
		}
		if(!empty($actual)){
			$result_array['data'][1]['name']='Actual cost' ;
			$result_array['data'][1]['value']=$actual ;
		}
		if(!empty($budget)){
			$result_array['data'][2]['name']='Budget' ;
			$result_array['data'][2]['value']=$budget ;
		}
		if(!empty($project))
		{
			$projectIds =  implode(",", $project);
			$result_array['data'][3]['name']='Project' ;
			$result_array['data'][3]['value']=$projectIds ;
		}
		return $result_array;
		
	}

}
