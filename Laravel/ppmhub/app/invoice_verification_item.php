<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice_verification_item extends Model
{

    protected $table = 'invoice_verification_item';
    public $timestamps = true;
    protected $fillable = [
        'purchase_order_item_no',
        'item_description',
        'goods_receipt_indicator',
        'po_order_number',
        'po_order_value',
        'po_order_qty',
        'qty_recevied',
        'quantity_returned',
        'additional_quantity',
        'g_r_amount',
        'invoice_value',
        'difference',
        'tax_code',
        'tax_amount',
        'g_l_account',
        'project_id',
        'phase_id',
        'task_id',
        'invoice_id',
        'posted_status',
        'currency',
        'created_by',
        'changed_by',
        'company_id',
        'cost_center',
        'status',
        'reversed'
    ];

}
