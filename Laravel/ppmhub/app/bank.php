<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bank extends Model
{
    protected $table    = 'bank';
    
    public $timestamps = true;
    
    protected $fillable = [
          'bank_name',
           'status'
      ];
}
