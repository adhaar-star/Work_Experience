<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class demand_forecasting extends Model
{
     protected $table = 'demand_forecasting';
    public $timestamps = true;
    protected $fillable = [
        'project_id',
        'forecast',
        'forecast_total',        
        'company_id',
        'start_date',   
        'end_date',
        'changed_by',
        'created_at',
        'updated_at'
        ];
}
