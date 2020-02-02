<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Roleauth;
use App\Project;
use App\purchase_order;
use App\purchaseorder_item;
use Yajra\DataTables\Facades\DataTables;

class PurchaseOrderReportController extends Controller {

    public function purchaseorder(Request $request) {
        
        $projectlist = array();
        $project_data = Project::where('project.company_id', '=', Auth::user()->company_id)->get();
        foreach ($project_data as $key => $project) {
            $projectlist[$project->id] = $project->project_Id . ' ( ' . $project->project_name . ' )';
        }
        return view('admin.report.purchaseorder', compact('projectlist', 'report','grap_data'));
    }
    
    public function purchaseOrderDataTable(Request $request) {
        
       $report = purchase_order::purchaseOrderReport($request->reportProject_from,$request->reportProject_to); 
       return DataTables::of($report)
               ->editColumn('status', function ($report) {
                      if($report->status == 'approved')
                      return '<img src="/vendors/common/img/green.png" />';
                      elseif($report->approved_indicator=='rejected' || $report->approved_indicator=='' )
                      return '<img src="/vendors/common/img/red.png" />';
                      else
                      return '<img src="/vendors/common/img/yellow.png" />';
                    })
               ->rawColumns(['status', 'confirmed'])
               ->make();
    }
	
	
	public function purchaseordergraphDataTable(Request $request) {
		$reportProject_from = $request->input('fromid');
		$reportProject_to = $request->input('toid');
		
		$report = purchase_order::purchaseOrderReportGraph($reportProject_from,$reportProject_to); 
		return DataTables::of($report)
               ->editColumn('status', function ($report) {
                      if($report->status == 'approved')
                      return '<img src="/vendors/common/img/green.png" />';
                      elseif($report->approved_indicator=='rejected' || $report->approved_indicator=='' )
                      return '<img src="/vendors/common/img/red.png" />';
                      else
                      return '<img src="/vendors/common/img/yellow.png" />';
                    })
               ->rawColumns(['status', 'confirmed'])
               ->make();
    }
	
	
	
	
	

}
