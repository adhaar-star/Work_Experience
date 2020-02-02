<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class materialmaster extends Model {

    protected $table = 'material_master';
    protected $fillable = [
        'material_number',
        'material_name',
        'customer_id',
        'material_description',
        'material_category',
        'material_group',
        'supplier_name',
        'unit_of_measure',
        'ordering_unit',
        'standard_price',
        'stock_item',
        'EAN_UPC_number',
        'tax_classification',
        'expiry_date',
        'min_stock',
        'reorder_quantity',
        'gross_weight',
        'status',
        'nett_weight',
        'currency',
    ];
    public $timestamps = true;

    function scopeByCompany($query, $company_id=false)
    {
        return $query->where('company_id', ($company_id) ? $company_id : Auth::user()->company_id );
    }


}
