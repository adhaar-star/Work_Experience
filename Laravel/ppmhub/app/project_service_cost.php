<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project_service_cost extends Model
{

    protected $table = 'project_service_cost';
    public $timestamps = false;
    protected $fillable = [
        'project_number',
        'task',
        'purchase_order',
        'service_descripton',
        'po_item_no',
        'quantity',
        'type',
        'currency',
        'total_price',
    ];

}
