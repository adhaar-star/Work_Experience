<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class glaccountpayment extends Model
{
    protected $table = 'glaccount_payment';
    public $timestamps = false;
    protected $fillable = [
        'glaccount_payment',        
        'status'
    ];
}
