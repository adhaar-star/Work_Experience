<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project_miscellanous_cost extends Model
{
    
    protected $table = 'project_miscellanous_cost';
    public $timestamps = false;
    protected $fillable = [
        'project_number',
        'task',
        'miscellanous',
        'currency',
        'total_price',
        'type'
    ];
}
