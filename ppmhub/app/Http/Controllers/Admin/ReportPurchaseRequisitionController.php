<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\purchase_requisition;
use App\Roleauth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class ReportPurchaseRequisitionController extends Controller {

  public function purchaserequisition(Request $request) {
    Roleauth::check('project.create');
    //get project
    $projectlist = array();
    $project_data = Project::where('project.company_id', '=', Auth::user()->company_id)->get();
    foreach ($project_data as $key => $project) {
      $projectlist[$project->id] = $project->project_Id . ' ( ' . $project->project_name . ' )';
    }
    return view('admin.report.purchaserequisition', compact('projectlist', 'graph', 'report', 'reportbucket_id', 'reportProject_from', 'reportProject_to', 'reportportfolio_id', 'request_p'));
  }

  /**
   * Get purchase_requisition report data datatables
   * @param Request $request
   * @return type
   */
  public function purchaserequisitionDataTable(Request $request) {
    $reportProject_from = $request->reportProject_from;
    $reportProject_to = $request->reportProject_to;
    $report = purchase_requisition::purchaseRequisitionReport($reportProject_from, $reportProject_to);
    return DataTables::of($report)
            ->editColumn('approved_indicator', function ($report) {
                            if ($report->approved_indicator == 'approved')
                                return '<img src="/vendors/common/img/green.png" />';
                            elseif ($report->approved_indicator == 'rejected' || $report->approved_indicator == '')
                                return '<img src="/vendors/common/img/red.png" />';
                            else
                                return '<img src="/vendors/common/img/yellow.png" />';
                        })
                        ->rawColumns(['approved_indicator'])
            ->make();
  }
  public function purchaserequisitionGraphDataTable(Request $request) {
  
    $reportProject_from = $_GET['fromid'];
    $reportProject_to = $_GET['toid'];
    $report = purchase_requisition::purchaseRequisitionReportGraph($reportProject_from, $reportProject_to);
    return DataTables::of($report)
                        ->rawColumns(['approved_indicator'])
            ->make();
  }

}
