<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class purchaseorder_item extends Model {

    protected $table = 'purchaseorder_item';
    public $timestamps = false;
    protected $fillable = [
        'status',
        'item_no',
        'item_category',
        'material',
        'material_description',
        'item_quantity',
        'item_quantity_gr',
        'quantity_unit',
        'item_cost',
        'currency',
        'delivery_date',
        'material_group',
        'vendor',
        'requestor',
        'contract_number',
        'contract_item_number',
        'purchase_order_number',
        'project_id',
        'phase_id',
        'task_id',
        'g_l_account',
        'cost_center',
        'created_by',
        'created_on',
        'changed_by',
        'processing_status',
        'title',
        'name',
        'add1',
        'add2',
        'postal_code',
        'country',
        'company_id'
    ];

    public static function purchaseOrderItemTotal() {
        $query = self::query()
                ->select('purchaseorder_item.vendor', 'vendor.name as vendor_name', 
                        DB::raw('sum(purchaseorder_item.item_quantity * purchaseorder_item.item_cost) as order_cost'))
                ->leftJoin('vendor', 'vendor.id', '=', 'purchaseorder_item.vendor')
                ->leftJoin('project', 'project.id', '=', 'purchaseorder_item.project_id')
                ->where('project.company_id', '=', Auth::user()->company_id)
                ->groupBy('purchaseorder_item.vendor', 'vendor.name')
                ->orderBy('purchaseorder_item.vendor', 'ASC');
        return $query->get();
    }

}
