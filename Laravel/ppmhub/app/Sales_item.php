<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales_item extends Model {

    protected $table = 'sales_item';
    public $timestamps = false;
    protected $fillable = [
        'item',
        'sales_orderno',
        'material_number',
        'order_qty',
        'material_description',
        'first_delivery_date',
        'net_value',
        'currency',
        'pricing_date',
        'usage',
        'unloading_point',
        'shipping_point',
        'gross_weight',
        'weight_unit',
        'net_weight',
        'volume',
        'volume_unit',
        'billing_block'
    ];

}
