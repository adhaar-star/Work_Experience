<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inquiry_type extends Model
{
    protected $table    = 'inquiry_type';
    
    public $timestamps = true;
    
    protected $fillable = [
          'inquiry_type',
           'status'
      ];
}
