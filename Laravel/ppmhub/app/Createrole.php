<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Createrole extends Model
{

    protected $table = 'createrole';
    // public $timestamps = false;
    protected $fillable = [
        'project_id',
        'role_name',
        'role_type',
        'resource_name',
        'role_fun',
        'description',
        'start_date',
        'end_date',
        'created_by',
        'changed_by',
        'company_id',
    ];
    protected $editable = [
        'project_id',
        'role_name',
        'role_type',
        'resource_name',
        'role_fun',
        'description',
        'start_date',
        'end_date',
        'changed_by'
    ];

    public function getEditable()
    {
        return $this->editable;
    }

}
