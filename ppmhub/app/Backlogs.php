<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Backlogs extends Model
{
      protected $table = 'backlog';
 
    protected $fillable = [
        'sprint_no', 
        'issue_no',
        'component_no',  
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
    
        public function issue()
    {
        return $this->hasOne('App\ProjectIssue', 'id', 'issue_no');
    }
    
    
}
