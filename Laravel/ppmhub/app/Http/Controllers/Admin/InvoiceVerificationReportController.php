<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ProjectHelpers;
use Illuminate\Support\Facades\Auth;
use App\invoice_verification;
use App\accounts_payable;
use App\purchase_order;
use Yajra\DataTables\Facades\DataTables;
use App\GlAccount;
use Illuminate\Support\Facades\DB;

class InvoiceVerificationReportController extends Controller {

    public function invoiceverification(Request $request) {

        $purchaseorders = $request->invoicereportpurchaseorder;
        $purchaseOrder = array();
        $purchaseOrderData = invoice_verification::all()->where('transaction','Invoice');

        foreach ($purchaseOrderData as $key => $po) {
            $purchaseOrder[$po->po_order_number] = $po->po_order_number;
        }

        return view('admin.report.invoiceverification', compact('purchaseOrder'));
    }

    public function invoiceverificationDataTable(Request $request) {
        $purchaseorders = $request->invoicereportpurchaseorder;

        $report = invoice_verification::invoiceReport($purchaseorders);

        $report = self::getAccountData($report, $purchaseorders);
        return DataTables::of($report)->editColumn('indicator', function ($report) {
                            if ($report->payable > 0)
                                return 'CR';
                            else
                                return 'DR';
                        })->rawColumns(['indicator'])
                        ->make();
    }

    public function getAccountData($report, $purchaseorders) {
        $gr_ir_query = DB::table('gr_ir')
                ->select('gr_ir.gl_account as gr_ir_gl_account', 'gr_ir.dr_cr_indicator as gr_ir_indicator', 'gr_ir.amount as gr_ir_amount', 'gr_ir.po_number', 'gr_ir.material_documber_number', 'gr_ir.item')
                ->where(['gr_ir.transaction_type' => 2, 'po_number' => $purchaseorders])
                ->get();

        foreach ($report as $key => $item) {

            $projectid = $item->project_Id;
            $report[$key]->total_cost = ProjectHelpers::get_project_planned_cost($projectid);


            $account_payable = accounts_payable::selectRaw('sum(amount) as payable, account_id')
                    ->groupBy('account_id')
                    ->where('account_id', $item->vendor_id)
                    ->where('dr_cr_indicator', 'CR')
                    ->get();

            $account_payable_DR = accounts_payable::selectRaw('sum(amount) as payable, account_id')
                    ->groupBy('account_id')
                    ->where('account_id', $item->vendor_id)
                    ->where('dr_cr_indicator', 'DR')
                    ->get();

            $account_payable_gl_act = GlAccount::where(['type_flag' => 'L0002', 'company_id' => Auth::user()->company_id])->first();
            foreach ($account_payable as $ckey => $cvalue) {
                $report[$key]->payable = $account_payable[$ckey]->payable;
                if (count($account_payable_DR) > 0) {
                    foreach ($account_payable_DR as $dkey => $dvalue) {
                        if ($cvalue->account_id == $dvalue->account_id) {
                            $report[$key]->payable = $account_payable[$ckey]->payable - $account_payable_DR[$dkey]->payable;
                        }
                    }
                }
            }
            $report[$key]->account_payable_gl = $account_payable_gl_act->number;

            foreach ($gr_ir_query as $grkey => $grvalue) {
                if ($report[$key]->po_order_number == $gr_ir_query[$grkey]->po_number) {
                    if ($report[$key]->id == $gr_ir_query[$grkey]->material_documber_number) {
                        if ($report[$key]->purchase_order_item_no == $gr_ir_query[$grkey]->item) {
                            $report[$key]->gr_ir_gl_account = $gr_ir_query[$grkey]->gr_ir_gl_account;
                            $report[$key]->gr_ir_indicator = $gr_ir_query[$grkey]->gr_ir_indicator;
                            $report[$key]->gr_ir_amount = $gr_ir_query[$grkey]->gr_ir_amount;
                        }
                    }
                }
            }
        }
        return $report;
    }

}
