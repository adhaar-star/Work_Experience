<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quotation extends Model {

    protected $table = 'quotation';
    public $timestamps = false;
    protected $fillable = [
        'quotation_number',
        'quotation_type',
        'quotation_description',
        'inquiry',
        'sales_order',
        'quotation_gross_price',
        'quotation_discount',
        'quotation_discount_amt',
        'quotation_discount_gross_price',
        'quotation_sales_taxamt',
        'quotation_net_price',
        'quotation_freight_charges',
        'quotation_total_price',
        'changed_on',
        'changed_by',
        'created_on',
        'created_by',
        'status',
        'company_id',
        'customer',
        'customer_name',
        'sales_organization',
        'sales_region',
        'requested_by',
        'quotation_profit_margin',
        'quotation_profit_amt',
        'quotation_profit_margin_grossprice'
    ];


    function scopeByCompany($query, $company_id)
    {
        return $query->where('company_id', $company_id);
    }
}
