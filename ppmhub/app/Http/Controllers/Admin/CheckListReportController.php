<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Roleauth;
use App\projectchecklist;
use App\User;
use App\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use DateTime;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\ProjectHelpers;

class CheckListReportController extends Controller {

    public function checklistreport(Request $request) {

        Roleauth::check('project.create');

        $reportProject_from = $request->reportProject_from;
        $reportProject_to = $request->reportProject_to;
        $reportName = $request->name;
        $reportChecklist_id = $request->checklist_id;
        $request_p = $request->e;
        $projectlist = array();

        $project_data = Project::where('project.company_id', '=', Auth::user()->company_id)->get();
        foreach ($project_data as $key => $project) {
            $projectlist[$project->id] = $project->project_Id . ' ( ' . $project->project_name . ' )';
        }

        $checklist = array();
        $projectCheck_data = projectchecklist::all();
        foreach ($projectCheck_data as $key => $checkdata) {
            $checklist[$checkdata->checklist_id] = $checkdata->checklist_id . ' ( ' . $checkdata->checklist_name . ' )';
        }

        $userlist = array();
        $user_data = User::all();
        foreach ($user_data as $key => $data) {
            $userlist[$data->name] = $data->name;
        }

        return view('admin.report.checklistreport', compact('userlist', 'projectlist', 'checklist', 'report', 'reportProject_from', 'reportProject_to', 'reportProject_desc', 'reportName', 'reportChecklist_id', 'reportChecklist_name', 'request_p'));
    }

    public static function export_checklist_html($reportProject_from = null, $reportProject_to = null, $reportName = null, $reportChecklist_id = null) {
        if (isset($reportProject_from) && isset($reportProject_to)) {
            $report = projectchecklist::checkListReport($reportProject_from, $reportProject_to, $reportName, $reportChecklist_id);
        }

        if (isset($reportProject_from))
            $from = "reportProject_from=$reportProject_from";
        else
            $from = "";
        if (isset($reportProject_to))
            $to = "reportProject_to=$reportProject_to";
        else
            $to = "";
        if (isset($reportChecklist_id))
            $check_id = "check_id=$reportChecklist_id";
        else
            $check_id = "";
        if (isset($reportName))
            $name = "name=$reportName";
        else
            $reportName = "";

        if (count($report) == 0) {
            return Redirect::to('admin/checklistreport?' . $from . '&' . $to . '&' . $name . '&' . $check_id . '&e=*h-');
        }

        $file = "Checklist_Report.html";
        header("Content-type: application/vnd.html");
        header("Content-Disposition: attachment; filename=$file");
        echo '

		<div style="width:100%;float:left"><h2>Project Report: Check List Report</h2></div>
		<table width="100%">

		<tr style="border:1px solid #ccc";>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Project ID</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Project Description</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Person Responsible</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Checklist ID</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Checklist Description</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Checklist Status</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Checklist Date</b></th>
		</tr>
		';
        foreach ($report as $data) {
            if (isset($data->created_on)) {
                $created_on = new DateTime($data->created_on);
                $created_on = $created_on->format('Y-m-d');
            } else {
                $created_on = "";
            }
            if ($data->checklist_status == 'OK') {
                $status = "OK";
            } elseif ($data->checklist_status == 'Not OK') {
                $status = "NOT OK";
            } else {
                $status = "Closed";
            }
            echo '
			<tr style="border:1px solid #ccc";>
			<td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->project_Id . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->project_desc . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->responsible_person . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->checklist_id . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->checklist_name . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $status . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $created_on . '</b></td>
			</tr>
			';
        }
        echo '</table>';
    }

    public function checklistreportDataTable(Request $request) {
        $reportProject_from = $request->reportProject_from;
        $reportProject_to = $request->reportProject_to;
        $reportName = $request->name;
        $reportChecklist_id = $request->checklist_id;
        $request_p = $request->e;
        $report = projectchecklist::checkListReport($reportProject_from, $reportProject_to, $reportName, $reportChecklist_id);
        return DataTables::of($report)
                  ->editColumn('checklist_status', function ($report) {
                      if($report->checklist_status == 'OK')
                      return '<img src="/vendors/common/img/green.png" />';
                      elseif($report->checklist_status == 'Not OK')
                      return '<img src="/vendors/common/img/red.png" />';
                      else
                      return '<img src="/vendors/common/img/yellow.png" />';
                    })
                    ->editColumn('project_Id', function ($report) {
                      return '<a data-toggle="modal" id="modal_popup" data-target="#table-pro-view-popup" data-id="'.$report->project_uid.'">'.$report->project_Id.'</a>';
                    })
                    ->rawColumns(['project_Id','checklist_status'])
                    ->make();
    }
	
	public function checklistreportgraphDataTable(Request $request) {
        $reportProject_from = $request->reportProject_from;
        $reportProject_to = $request->reportProject_to;
     
		
		$total_checklist = array();
		$open_checklist = array();
		$closed_checklist = array();
		$project = array();
		$result_array = array();
        $report = projectchecklist::checkListReportGraph($reportProject_from, $reportProject_to);
		foreach ($report as $key => $value) {
		
				$open_closed_checklist = ProjectHelpers::get_project_checklist_counts($value->project_id);
				$open_closed_checklist_array = explode("|",$open_closed_checklist);
				$open_checklist[] = round($open_closed_checklist_array[0]);
				$closed_checklist[] = round($open_closed_checklist_array[1]);
				$total_checklist[] = $value->total_checklist;
				$project[] = $value->project_id; 
				
		}
		if(!empty($open_checklist)){
			$result_array['data'][2]['name']='Open checklist' ;
			$result_array['data'][2]['value']=$open_checklist ;
		}
		if(!empty($closed_checklist)){
			$result_array['data'][1]['name']='Close checklist' ;
			$result_array['data'][1]['value']=$closed_checklist ;
		}
		
		if(!empty($total_checklist)){
			$result_array['data'][0]['name']='Total checklist' ;
			$result_array['data'][0]['value']=$total_checklist ;
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
