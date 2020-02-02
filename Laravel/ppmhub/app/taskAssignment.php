<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class taskAssignment extends Model
{

    protected $table = 'taskassign';
    // public $timestamp = false;
    protected $fillable = [
        'project_id',
        'project_description',
        'task',
        'role',
        'role_description',
        'start_date',
        'end_date',
        'created_by',
        'changed_by',
        'company_id'
    ];
    protected $editable = [
        'project_id',
        'project_description',
        'task',
        'role',
        'role_description',
        'start_date',
        'end_date',
        'changed_by',
        
    ];

    public function getEditable()
    {
        return $this->editable;
    }
    
    public static function taskAssignedByProject($id)
    {
        $taskAssign = DB::table('taskassign')
                        ->select('taskassign.*')
                        ->where('project_id', $id)
                        ->where('company_id', Auth::user()->company_id)
                        ->get()->toArray();
        return $taskAssign;
    }

}
