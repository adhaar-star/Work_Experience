<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project_hardware_cost extends Model
{
    protected $table = 'project_hardware_cost';
    public $timestamps = false;
    protected $fillable = [
        'project_number',
        'task',
        'purchase_order',
        'hardware_item_descripton',
        'po_item_no',
        'quantity',
        'type',
        'currency',
        'total_price',
    ];
}
