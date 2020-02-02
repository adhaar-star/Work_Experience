<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
  protected $table = 'component';
 
            
    protected $fillable = [
        'component_name',
        'component_number',   
        'sprint_no', 
        'project_id',      
        'status',
        'created_by',
        'created_on',
        'created_at',
        'changed_by',
        'changed_on',
        'updated_at',      
    ];
    
     public function user()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }
    
    
     public function user_changed_by()
    {
        return $this->hasOne('App\User', 'id', 'changed_by');
    }
}
