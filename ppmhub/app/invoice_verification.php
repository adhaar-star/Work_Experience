<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\GlAccount;
use Illuminate\Support\Facades\Auth;

class invoice_verification extends Model {

    protected $table = 'invoice_verification';
    public $timestamps = true;
    protected $fillable = [
        'transaction',
        'invoice_number',
        'invoice_date',
        'posting_date',
        'vendor',
        'po_order_number',
        'reversed',
        'posted_status',
        'created_by',
        'changed_by',
        'company_id'
    ];

    public static function invoiceReport($purchase_order) {
        $account_payable = GlAccount::where(['type_flag' => 'L0002', 'company_id' => Auth::user()->company_id])->first();
        $query = self::query();
        $query->select('invoice_verification.id', 'invoice_verification_item.invoice_value', 
                'vendor.name', 'vendor.id as vendor_id', 'invoice_verification_item.g_l_account as inv_g_l_account',
                'invoice_verification_item.purchase_order_item_no',
                'project.project_Id', 'invoice_verification.posting_date',
                'invoice_verification.po_order_number', 
                'invoice_verification_item.qty_recevied as quantity_received',
                DB::raw('(invoice_verification_item.invoice_value/invoice_verification_item.qty_recevied) as item_cost'),
                DB::raw('(invoice_verification_item.po_order_qty - invoice_verification_item.qty_recevied) as item_quantity_gr'));
        $query->join('invoice_verification_item', 'invoice_verification.id', '=', 'invoice_verification_item.invoice_id');
        $query->leftJoin('vendor', 'vendor.id', '=', 'invoice_verification.vendor');
        $query->leftJoin('project', 'project.id', '=', 'invoice_verification_item.project_id');
        $query->orderBy('invoice_verification.id');
        $query->where('invoice_verification.transaction','Invoice');


        if (isset($purchase_order)) $query->where('invoice_verification.po_order_number', $purchase_order);

        $report = $query->get();
        foreach ($report as $key => $value) {
            $report[$key]->payable = 0;
        }
        return $report;
    }

}
