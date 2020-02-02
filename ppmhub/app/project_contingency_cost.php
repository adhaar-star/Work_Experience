<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project_contingency_cost extends Model
{
    protected $table = 'project_contingency_cost';
    public $timestamps = false;
    protected $fillable = [
        'project_number', 'task', 'contingency', 'currency', 'total_price','type'
    ];
}
