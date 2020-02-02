<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gr_ir extends Model
{
   protected $table = 'gr_ir';
    public $timestamps = false;
    protected $fillable = [
        'vendor_id',
        'po_number',
        'item',
        'amount',
        'dr_cr_indicator',
        'currency',
        'material_documber_number',
        'posting_date',
        'posted_by',
        'invoice_verification',
        'created_at',
        'updated_at',
        'gl_account',
        'ir_value',
        'transaction_type'
    ];
           
}
