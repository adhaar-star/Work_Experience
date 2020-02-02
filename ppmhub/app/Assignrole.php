<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignrole extends Model
{

    protected $table = 'assignrole';
    // public $timestamps = false;
    protected $fillable = [
        'project_id',
        'resource_name',
        'role_type',
        'role',
        'role_fun',
        'start_date',
        'end_date',
        'created_by',
        'changed_by',
        'company_id',
    ];
    protected $editable = [
        'project_id',
        'resource_name',
        'role_type',
        'role',
        'role_fun',
        'start_date',
        'end_date',
        'changed_by'
    ];

    public function getEditable()
    {
        return $this->editable;
    }

}
