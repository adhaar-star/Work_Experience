<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquirynumber_range extends Model {

    protected $table = 'inquirynumber_range';
    public $timestamps = false;
    protected $fillable = [
        'start_range',
        'end_range',
        'company_id'
    ];

}
