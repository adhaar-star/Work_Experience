<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project_external_cost extends Model
{
    protected $table = 'project_external_resource_cost';
    public $timestamps = false;
    protected $fillable = [
        'project_number',
        'task',
        'resource role',
        'resource_id',
        'resource_name',    
        'purchase_order',
        'requisition_item',
        'activity_type',
        'contract_vendor',
        'no_hours',
        'unit_rate',
        'currency',
        'total_price',
        'type'
    ];
}
