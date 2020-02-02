<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quantitative_riskscore extends Model
{
    protected $table = 'quantitative_riskscore';
    protected $fillable = [
        'start_range',
        'end_range',
        'risk_value',
        'risk_status',
        'company_id'
    ];
    public $timestamps = true;
}
