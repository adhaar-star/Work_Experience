<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salesregion extends Model
{
    protected $table    = 'salesregion';
    
    public $timestamps = true;
    
    protected $fillable = [
          'sales_region',
           'status'
      ];
}
