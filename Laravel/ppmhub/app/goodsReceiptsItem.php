<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class goodsReceiptsItem extends Model
{
    protected $table = 'goods_receipt_item';
    public $timestamps = false;
    protected $fillable = [
    'goods_receipt_no',
    'purchase_order_number',
    'purchase_order_item_no',
    'item_description',
    'vendor_number',
    'vendor_name',
    'purchase_order_quantity',
    'quantity_received',
    'quantity_remaining',
    'bill_of_lading',
    'delivery_note',
    'status',
    'reversed',    
    'company_id',
    'item_cost',
    'project',
    'phase',
    'task',
    'cost_center',
    'gl_account'    
    ];
}
