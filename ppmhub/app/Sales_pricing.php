<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales_pricing extends Model {

    protected $table = 'sales_pricing';
    public $timestamps = false;
    protected $fillable = [
        'sales_orderno',
        'item_no',
        'base_price',
        'gross_value',
        'discount',
        'net_value',
        'down_payment',
        'output_tax',
        'freight',
        'total',
        'g_l_account_base',
        'g_l_account_tax',
        'g_l_account_freight',
        'g_l_account_down'
    ];

}
