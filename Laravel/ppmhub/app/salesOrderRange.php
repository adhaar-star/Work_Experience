<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salesOrderRange extends Model {

    protected $table = 'salesOrderNumber_range';
    public $timestamps = false;
    protected $fillable = [
        'start_range',
        'end_range',
        'company_id'
    ];

}
