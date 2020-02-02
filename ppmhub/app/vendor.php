<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vendor extends Model {

    protected $table = 'vendor';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'vendor_id',
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
        'onetime_vendor',
        'approved_vendor',
        'category',
        'payment_terms',
        'abn_no',
        'acn_no',
        'e_invoice',
        'bank_name',
        'bsb',
        'account_no',
        'ifsc_code',
        'contact_role',
        'status',
        'contact_name',
        'contact_phone',
        'contact_email',
        'created_at',
        'updated_at'
    ];

}