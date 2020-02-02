<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customerinquiry extends Model {

    protected $table = 'customer_inquiry';
    public $timestamps = false;
    protected $fillable = [
        'inquiry_number',
        'inquiry_description',
        'quotation',
        'sales_order',
        'inquiry_gross_price',
        'inquiry_discount',
        'inquiry_discount_amt',
        'inquiry_discount_gross_price',
        'inquiry_sales_taxamt',
        'inquiry_net_price',
        'inquiry_freight_charges',
        'inquiry_total_price',
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
        'inquiry_type',
        'requested_by'
    ];


    function scopeByCompany($query, $company_id)
    {
        return $query->where('company_id', $company_id);
    }    

}
