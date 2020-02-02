<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderingunit extends Model
{
    protected $table    = 'ordering_unit';
    
    public $timestamps = true;
    
    protected $fillable = [
          'orderingunit',
           'status'
      ];
}
