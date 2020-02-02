<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class glaccounttax extends Model
{
    protected $table = 'glaccount_tax';
    public $timestamps = false;
    protected $fillable = [
        'glaccount_tax',        
        'status'
    ];
}
