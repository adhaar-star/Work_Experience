<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project_material_cost extends Model
{

    protected $table = 'project_material_cost';
    public $timestamps = false;
    protected $fillable = [
        'project_number',
        'task',
        'material_number',
        'description',
        'quantity',
        'type',
        'unit_price',
        'currency',
        'total_price',
        
    ];

}
