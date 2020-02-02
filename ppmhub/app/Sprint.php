<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
  protected $table = 'sprint';

    protected $fillable = [
        'project_id',
        'sprint_number',   
        'sprint_period', 
        'start_date',
        'end_date',
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
