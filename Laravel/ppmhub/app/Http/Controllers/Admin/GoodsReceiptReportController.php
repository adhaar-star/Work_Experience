<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\purchase_order;
use App\GoodsReceipt;
use App\Helpers\ProjectHelpers;
use App\project_gr_cost;
use Yajra\DataTables\Facades\DataTables;

class GoodsReceiptReportController extends Controller {

    public function goodsreceipt(Request $request) {

        $purchaseOrder = array();
        $purchaseOrderData = purchase_order::all();
        foreach ($purchaseOrderData as $key => $po) {
            $purchaseOrder[$po->purchase_order_number] = $po->purchase_order_number;
        }
        return view('admin.report.goodsreceipt', compact('purchaseOrder'));
    }

    public function goodsreceiptDataTable(Request $request) {
        $purchaseorders = $request->reportpurchaseorder;
        $report = GoodsReceipt::getGoodsReceiptData($purchaseorders);
        foreach ($report as $key => $value) {
            $report[$key]['gr_cost'] =  $value['item_cost'] * $value['quantity_received'];
            $report[$key]['total_value'] = ProjectHelpers::get_project_planned_cost($value['project_Id']);
        }
        return DataTables::of($report)->make();
        
    }

}
