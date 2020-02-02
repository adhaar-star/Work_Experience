<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projectlabel extends Model
{

    
        protected $table = 'labels';

    protected $fillable = [
        'label_name',
        'label_color',     
        'created_by',
        'created_on',
        'changed_by',
        'changed_on',
        'created_at',
        'updated_at',
       
    ];
    
    
     public function issues_list()
    {
        return $this->hasMany('App\ProjectIssue', 'label_id');
    }
    
      public function issues_list_array()
    {
         
   return $this->hasMany('App\ProjectIssue', 'label_id');
    }
    
}
