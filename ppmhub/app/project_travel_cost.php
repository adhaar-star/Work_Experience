<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project_travel_cost extends Model
{
    protected $table = 'project_travel_cost';
    public $timestamps = false;
    protected $fillable = [
        'project_number', 'task', 'travel_request_number', 'currency', 'total_price','type'
    ];
}
