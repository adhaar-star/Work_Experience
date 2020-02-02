<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class procurement_GST extends Model {

    protected $table = 'procurement_GST';
    public $timestamps = true;
    protected $fillable = [
        'gl_account_no',
        'gl_account_description',
        'cost_element_type',
        'amount',
        'dr_cr_indicator',
        'balance',
        'year',
        'period',
        'cleared',
        'company_id',
        'created_at',
        'updated_at',
    ];

}
