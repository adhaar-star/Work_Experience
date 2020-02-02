<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class customer_master extends Model
{
    protected $table = 'customer_master';
    
    public $timestamps = true;
    
    protected $fillable = [
        'name',
        'customer_id',
        'customer_id',
        'website_address',
        'office_phone',
        'fax',
        'street',
        'city',
        'state',
        'postal_code',
        'country',
        'email',
        'tax_no',
        'onetime_customer',
        'approved_customer',
        'category',
        'payment_terms',
        'abn_no',
        'acn_no',
        'e_invoice',
        'bank_name',
        'bsb',
        'account_no',
        'ifsc_code',
        'status',
        'contact_name',
        'contact_role',
        'contact_email',
        'contact_phone'        
    ];

    function scopeByCompany($query, $company_id=false)
    {
        return $query->where('company_id', ($company_id) ? $company_id : Auth::user()->company_id );
    }
    
}
