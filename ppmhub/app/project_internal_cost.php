<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project_internal_cost extends Model
{
    
    protected $table = 'project_internal_resource_cost';
    public $timestamps = false;
    protected $fillable = [
        'project_number',
        'task',
        'resource role',
        'resource_id',
        'resource_name',
        'band',
        'no_hours',
        'unit_rate',
        'currency',
        'total_price',
        'type'
    ];
}
