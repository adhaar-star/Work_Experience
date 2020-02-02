<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project_facilities_cost extends Model
{
    protected $table = 'project_facilities_cost';
    public $timestamps = false;
    protected $fillable = [
        'project_number', 'task', 'facilities', 'currency', 'total_price','type'
    ];
}
