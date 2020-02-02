<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\OriginalBudget;
use App\BudgetSupplement;
use App\BudgetReturn;
use Illuminate\Support\Facades\DB;
use App\project_gr_cost;
use Redirect;
use View;
use App\Helpers\ProjectHelpers;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CostBudgetReportController extends Controller
{

    public function costbudget(Request $request)
    {
        $projectlist = array();
        $project_data = Project::where('project.company_id', '=', Auth::user()->company_id)->get();
        foreach ($project_data as $key => $project) {
            $projectlist[$project->id] = $project->project_Id . ' ( ' . $project->project_name . ' )';
        }

        $reportStart_date = $request->reportStart_date;
        $reportEnd_date = $request->reportEnd_date;
        $reportProject_from = $request->reportProject_from;
        $reportProject_to = $request->reportProject_to;
        $reportProject_desc = $request->reportProject_desc;
        $request_p = $request->e;

        return view('admin.report.costbudget', compact('originalBudget', 'projectlist', 'reportProject_from', 'reportProject_to', 'reportEnd_date', 'reportStart_date', 'request_p'));
    }

    public function export_costbudget_html($reportProject_from = null, $reportProject_to = null, $reportStart_date = null, $reportEnd_date = null)
    {

        $originalBudget = self::getCostBudgetDetail($reportProject_from, $reportProject_to, $reportStart_date, $reportEnd_date);

        if (isset($reportProject_to) && $reportProject_to != "-") {
            $to = "reportProject_to=$reportProject_to";
        } else {
            $to = "reportProject_to=$reportProject_to";
        }

        if (isset($reportProject_from) && $reportProject_from != "-") {
            $from = "reportProject_from=$reportProject_from";
        } else {
            $from = "reportProject_from=$reportProject_from";
        }

        if (isset($reportStart_date) && $reportStart_date != "-") {
            $start_date = "reportStart_date=$reportStart_date";
        } else {
            $start_date = "reportStart_date=$reportStart_date";
        }

        if (isset($reportEnd_date) && $reportEnd_date != "-") {
            $end_date = "reportEnd_date=$reportEnd_date";
        } else {
            $end_date = "reportEnd_date=$reportEnd_date";
        }

        if (count($originalBudget) == 0) {

            return Redirect::to('admin/costbudget?' . $from . '&' . $to . '&' . $start_date . '&' . $end_date . '&e=*h-');
        }

        $file = "CostBudget.html";
        header("Content-type: application/vnd.html");
        header("Content-Disposition: attachment; filename=$file");
        echo '
		<div style="width:100%;float:left"><h2>Project Report: Cost Budget Report</h2></div>
		<table width="100%">
		<tr style="border:1px solid #ccc";>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Project ID</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Project Description</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Planned Cost</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Actual Cost</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Overall Budget</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Available Budget</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Start Date</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>End Date</b></th>
		</tr>
		';
        foreach ($originalBudget as $data) {
            echo '
			<tr style="border:1px solid #ccc";>
			<td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->project_PID . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->project_desc . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->planned_cost . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->actual_cost . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->budget_org_overall . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->available_budget . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . date('Y-m-d', strtotime($data->p_start_date)) . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . date('Y-m-d', strtotime($data->p_end_date)) . '</b></td>
			</tr>
			';
        }
        echo '</table>';
    }

    public function getCostBudgetDetail($reportProject_from = NULL, $reportProject_to = NULL, $reportStart_date = NULL, $reportEnd_date = NULL)
    {

        $originalBudget = OriginalBudget::budgetOriginal($reportProject_from, $reportProject_to, $reportStart_date, $reportEnd_date);
        $supplementBudget = BudgetSupplement::supplementBudget();
        $returnBudget = BudgetReturn::returnBudget();

        foreach ($originalBudget as $key => $orbudget) {
                $originalBudget[$key]->actual_cost = ProjectHelpers::get_actual_cost_project($orbudget->project_id);
        }
        foreach ($originalBudget as $key => $value) {
            $originalBudget[$key]->planned_cost = 0;
            $originalBudget[$key]->planned_cost = round(ProjectHelpers::get_project_planned_cost($value['project_PID']), 2);
        }
        foreach($originalBudget as $orbudget){
             $orbudget['available_budget'] = $orbudget['budget_org_overall'] - $orbudget['actual_cost'];
        }
           
        return $originalBudget;
    }

    public function costBudgetReportDataTable(Request $request)
    {

        $reportStart_date = $request->reportStart_date;
        $reportEnd_date = $request->reportEnd_date;
        $reportProject_from = $request->reportProject_from;
        $reportProject_to = $request->reportProject_to;
        $reportProject_desc = $request->reportProject_desc;
        $request_p = $request->e;
//        if (isset($reportProject_from) && isset($reportProject_to)) {
        $originalBudget = self::getCostBudgetDetail($reportProject_from, $reportProject_to, $reportStart_date, $reportEnd_date);
//        } else {
//            $originalBudget = array();
//        }
        return DataTables::of($originalBudget)->make();
    }

}
