<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevenueServiceOffer extends Model
{
    protected $table = 'revenue_service_offer_cost';
    public $timestamps = false;
    protected $fillable = [
        'project_number',
        'task',
        'resource_role',
        'personal_no',
        'resource_name',
        'activity_type',
        'type',
        'hours',
        'total_hours',
        'unit_price',
        'currency',
        'total_price',
        
    ];
}
