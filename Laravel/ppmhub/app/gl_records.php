<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gl_records extends Model
{

    protected $table = 'gl_records';
    public $timestamps = false;
    protected $fillable = [
        'gl_account_number',
        'amount',
        'dr_cr_indicator',
        'company_id',
        'created_by',
        'changed_by',
        'remark',
        'ref_id',
        'item_no',
        'created_at',
        'updated_at',
        'purchase_order_no',
        'vendor',
        'invoice_number',
        'posting_date',
        'posted_by'
    ];

}
