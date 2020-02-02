<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class progress_calculation_cost_proportional extends Model
{
    protected $table = 'progress_calculation_cost_proportional';
    public $timestamps = true; 
    protected $fillable = [
    'project_id',
    'method',
    'start_date',
    'end_date',
    'planned_progress',
    'actual_progress',
    'planned_cost',
    'actual_cost',
    'BCWS',
    'BCWP',
    'ACWP',
    'cost_variance',
    'schedule_variance',
    'value_index',
    'created_by',
    'changed_by',
    'company_id',
    ];
    
    protected $editable = [
    'project_id',
    'method',
    'start_date',
    'end_date',
    'planned_progress',
    'actual_progress',
    'planned_cost',
    'actual_cost',
    'BCWS',
    'BCWP',
    'ACWP',
    'cost_variance',
    'schedule_variance',
    'value_index',
    'changed_by',
    ];
}
