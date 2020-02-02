<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer_number_range extends Model
{

    protected $table = 'customer_number_range';
    public $timestamps = true;
    protected $fillable = [
        'start_range',
        'end_range',
        'company_id'
    ];

}
