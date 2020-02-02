<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cost_centre_cost extends Model
{
    protected $table = 'cost_centre_cost';
    public $timestamps = false;
    protected $fillable = [
        'cost_centre',
        'description',
        'purchase_order_number',
        'item_number',
        'amount',
        'dr_cr_indicator',
        'currency',
        'material_documber_number',
        'posting_date',
        'posted_by',
        'created_at',
        'updated_at',
        'vendor',
        'gl_account',
        
        ];
    
}
