<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class revenue_forecast extends Model {

    protected $table = 'revenue_forecasting';
    public $timestamps = true;
    protected $fillable = [
        'project_id',
        'forecast',
        'company_id',
        'changed_by',
        'plan_cost',
        'forecast_total',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];

}
