<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quotationNumber extends Model {

    protected $table = 'quotationNumber_range';
    public $timestamps = false;
    protected $fillable = [
        'start_range',
        'end_range',
        'company_id'
    ];

}
