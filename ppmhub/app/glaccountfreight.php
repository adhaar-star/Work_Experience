<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class glaccountfreight extends Model
{
    protected $table = 'glaccount_freight';
    public $timestamps = false;
    protected $fillable = [
        'glaccount_freight',        
        'status'
    ];
}
