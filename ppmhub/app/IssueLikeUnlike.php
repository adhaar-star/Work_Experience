<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class IssueLikeUnlike extends Model {

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $table    = 'issuelikeunlike';
    
    protected $fillable = [
          'issueId',
          'action',
          'userId',
          'created_on',
          'updated_at',
          'created_at',
        
    ];
  
    
    
}