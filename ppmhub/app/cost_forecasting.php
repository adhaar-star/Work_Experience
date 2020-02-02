<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cost_forecasting extends Model
{
    protected $table = 'cost_forecasting';
    public $timestamps = true;
    protected $fillable = [
        'project_id',
        'forecast',
        'company_id',        
        'created_at',
        'updated_at',   
        'changed_by',
        'plan_cost',
        'forecast_total',
        'start_date',
        'end_date'
        ];
}
