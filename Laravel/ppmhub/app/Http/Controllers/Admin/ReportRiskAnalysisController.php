<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\qualitative_risk_analysis;
use App\quantitative_risk_analysis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;


class ReportRiskAnalysisController extends Controller {

  public function riskanalysis(Request $request) {
    $projectsFrom = $request->reportProject_from;
    $projectsTo = $request->reportProject_to;
    $risktype = $request->riskType;
    $status = $request->status;
    $request_p = $request->e;

    //get project
    $projectlist = array();
    $project_data = Project::where('project.company_id', '=', Auth::user()->company_id)->get();
    foreach ($project_data as $key => $project) {
      $projectlist[$project->id] = $project->project_Id . ' ( ' . $project->project_name . ' )';
    }

    if (isset($projectsFrom) && !isset($projectsTo) || !isset($projectsFrom) && isset($projectsTo)) {
      session()->flash('flash_message', 'Please select Project From and Project To both Id');
      return redirect('admin/riskanalysis');
    }

    //get qualitative data for piechart
    $chart_data = DB::table('qualitative_risk_analysis')
        ->select('qualitative_risk_analysis.project_id', DB::raw('sum(qualitative_risk_analysis.risk_score) as total'))
        ->groupBy('qualitative_risk_analysis.project_id')
        ->get()->toArray();
    $result = [];
    foreach ($chart_data as $key => $obj) {
      $result[$obj->project_id] = $obj->total;
    }

    //get quantitative data for piechart
    $quanchart_data = DB::table('quantitative_risk_analysis')
        ->select('quantitative_risk_analysis.project_id', DB::raw('sum(quantitative_risk_analysis.quan_risk_score) as total1'))
        ->groupBy('quantitative_risk_analysis.project_id')
        ->get()->toArray();
    $result1 = [];
    foreach ($quanchart_data as $key => $obj) {
      $result1[$obj->project_id] = $obj->total1;
    }
    
    return view('admin.report.riskanalysis', compact('result','result1','risktype','chart_data','report_quan', 'projectlist', 'report', 'status', 'reportProjectRisktype', 'projectsFrom', 'projectsTo', 'request_p'));
  }

  public function export_riskanalysis_html($projectsFrom = null, $projectsTo = null, $risktype = null, $status = null) {
    if (isset($projectsFrom) && isset($projectsTo)) {
      $qualitative_data = qualitative_risk_analysis::qualitativeReport($risktype, $projectsFrom, $projectsTo, $status);
      $quantitative_data = quantitative_risk_analysis::quantitativeReport($projectsFrom, $risktype, $projectsTo, $status);
    }

    if (isset($projectsFrom))
      $from = "reportProject_from=$projectsFrom";
    else
      $from = "";
    if (isset($projectsTo))
      $to = "reportProject_to=$projectsTo";
    else
      $to = "";
    if (isset($risktype))
      $risk_type = "riskType=$risktype";
    else
      $risk_type = "";
    if (isset($status))
      $status = "status=$status";
    else
      $status = "";

    if (count($qualitative_data) == 0 && count($quantitative_data) == 0) {
      return Redirect::to('admin/riskanalysis?' . $from . '&' . $to . '&' . $risk_type . '&' . $status . '&e=*h-');
    }
    
    $file = "Riskanalysis.html";
    header("Content-type: application/vnd.html");
    header("Content-Disposition: attachment; filename=$file");
    echo '
		<div style="width:100%;float:left"><h2>Project Report: Risk Analysis Report</h2></div>
		<table width="100%">
		<tr style="border:1px solid #ccc";>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Project ID</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Project Name</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Risk ID</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Risk Type</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Risk Score</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Status</b></th>
		</tr>';
    foreach ($qualitative_data as $data) {
      echo '
        <tr style="border:1px solid #ccc";>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->project_id . '</b></td>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->project_name . '</b></td>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->qual_risk_id . '</b></td>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->risk_type . '</b></td>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->risk_score . '</b></td>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->qual_status . '</b></td>
        </tr>';
    }
     foreach ($quantitative_data as $data) {
      echo '
        <tr style="border:1px solid #ccc";>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->project_id . '</b></td>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->project_name . '</b></td>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->quan_risk_id . '</b></td>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->risk_type . '</b></td>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->quan_risk_score . '</b></td>
        <td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->quan_status . '</b></td>
        </tr>';
    }
    echo '</table>';
  }
  
    /**
   * Get project report data datatables
   * @param Request $request
   * @return type
   */
  public function riskreportAnalysisDatatable(Request $request){
    $projectsFrom = $request->reportProject_from;
    $projectsTo = $request->reportProject_to;
    $risktype = $request->riskType;
    $status = $request->status;
    $qualitative_data = qualitative_risk_analysis::qualitativeReport($risktype, $projectsFrom, $projectsTo, $status);
    $quantitative_data = quantitative_risk_analysis::quantitativeReport($projectsFrom, $risktype, $projectsTo, $status);
    $result = array_merge($qualitative_data, $quantitative_data);
    return DataTables::of($result)->make();
  }
  
    /**
   * Get project report data datatables
   * @param Request $request
   * @return type
   */

   public function riskreportAnalysisGraphDatatable(Request $request){
    $projectsFrom = $request->reportProject_from;
    $projectsTo = $request->reportProject_to;
    $qualitative_data = qualitative_risk_analysis::qualitativeReportGraph($projectsFrom, $projectsTo);
    $quantitative_data = quantitative_risk_analysis::quantitativeReportGraph($projectsFrom, $projectsTo);
	$result_array['data']['qualitative_data'] = $qualitative_data;
	$result_array['data']['quantitative_data'] = $quantitative_data;
	return $result_array;
  }
  

}
