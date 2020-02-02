<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class milestone_type extends Model
{
    protected $table    = 'milestone_type';
    
    public $timestamps = true;
    
    protected $fillable = [
          'milestonetype',
           'status'
      ];
}
