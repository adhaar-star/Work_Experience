<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gl extends Model
{
    protected $table = 'gl';
    public $timestamps = false;
    protected $fillable = [
        'gl_account_number',
        'gl_account_description',
        'cost_element_type',
        'type_flag',
        'debit',
        'credit',
        'balance',
        'year',
        'Period',
        'status',
        'company_id'
    ];
}
