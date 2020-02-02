<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Sales_order;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ProjectHelpers;
use Yajra\DataTables\Facades\DataTables;

class ProjectSalesReportController extends Controller {

    public function salesreport(Request $request) {

        $sales_order_number_from = $request->sales_orderno_from;
        $sales_order_number_to = $request->sales_orderno_to;
        
                $sales_orderlist = array();
        $sales_orderno = Sales_order::all();
        foreach ($sales_orderno as $key => $value) {
            $sales_orderlist[$value->salesorder_number] = $value->salesorder_number;
        }

        return view('admin.report.salesreport', compact('report', 'sales_orderlist', 'sales_order_number_from','sales_order_number_to'));
    }

    public static function export_salesorder_html($sales_order_number_from = NULL,$sales_order_number_to = NULL) {
        if (isset($sales_order_number_from) && isset($sales_order_number_to)) {
            $report = self::getSalesOrderData($sales_order_number_from ,$sales_order_number_to );
        }

        $file = "SalesOrderReport.html";
        header("Content-type: application/vnd.html");
        header("Content-Disposition: attachment; filename=$file");
        echo '

		<div style="width:100%;float:left"><h2>Project Report: Check List Report</h2></div>
		<table width="100%">

		<tr style="border:1px solid #ccc";>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Project ID</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Project Description</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Planned Cost</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Actual Cost</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Planned revenue</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Actual Revenue</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Sales Order Number</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Sales Order Status</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Customer Number</b></th>
		</tr>
		';
        foreach ($report as $data) {
            echo '
			<tr style="border:1px solid #ccc";>
			<td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->project_Id . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->project_desc . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->planned_cost . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->actual_cost . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->planned_revenue . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . 'NA' . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->salesorder_number . '</b></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->status . '</b></td></td><td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->customer_phone_no . '</b></td>
			</tr>
			';
        }
        echo '</table>';
    }

    public static function getSalesOrderData($sales_order_number_from = NULL , $sales_order_number_to = NULL) {
        $report = Sales_order::getSalesOrderReport($sales_order_number_from ,$sales_order_number_to );
        
        foreach ($report as $key => $value) {
            $report[$key]->planned_cost = round(ProjectHelpers::get_project_planned_cost($value->project_Id), 2);
            $report[$key]->planned_revenue = ProjectHelpers::getPlannedRevenue($value->project_Id);
            $report[$key]->actual_cost = ProjectHelpers::get_actual_cost_project($value->project_uid);
            $report[$key]->actual_revenue = 0; //actual revenue module under development
        }
        return $report;
    }
    
    public function salesreportDataTable(Request $request) {
         $sales_order_number_from = $request->sales_orderno_from;
         $sales_order_number_to = $request->sales_orderno_to;
         $report = self::getSalesOrderData($sales_order_number_from,$sales_order_number_to);
         return DataTables::of($report)
                 ->editColumn('status', function ($report) {
                      if($report->status == 'approved')
                      return '<img src="/vendors/common/img/green.png" />';
                      elseif($report->status == 'rejected' || $report->status == '' )
                      return '<img src="/vendors/common/img/red.png" />';
                      else
                      return '<img src="/vendors/common/img/yellow.png" />';
                    })
                 ->rawColumns(['status', 'confirmed'])
                 ->make();
    }

}
