<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class materialgroup extends Model
{
    protected $table    = 'material_group';
    
    public $timestamps = true;
    
    protected $fillable = [
          'materialgroup',
           'status'
      ];
}
