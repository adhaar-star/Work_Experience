<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contract_item extends Model
{

    protected $table = 'contract_item';
    public $timestamps = false;
    protected $fillable = [
        'processing_status',
        'status',
        'purchase_orderno',
        'item_no',
        'item_category',
        'material',
        'material_description',
        'item_quantity',
        'quantity_unit',
        'item_cost',
        'currency',
        'delivery_date',
        'material_group',
        'vendor',
        'requestor',
        'aggreement_number',
    ];

}
