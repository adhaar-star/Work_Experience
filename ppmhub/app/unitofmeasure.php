<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class unitofmeasure extends Model
{
    protected $table    = 'unit_of_measure';
    
    public $timestamps = true;
    
    protected $fillable = [
          'unitofmeasure',
           'status'
      ];
}
