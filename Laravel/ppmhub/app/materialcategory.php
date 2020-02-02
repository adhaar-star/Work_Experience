<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class materialcategory extends Model
{
    protected $table    = 'material_category';
    
    public $timestamps = true;
    
    protected $fillable = [
          'materialcategory',
           'status'
      ];
}
