<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class postal_code extends Model
{
     protected $table    = 'postal_codes';
    
    protected $fillable = [
          'postal_code'
      ];
}
