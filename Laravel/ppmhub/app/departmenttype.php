<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departmenttype extends Model
{
    protected $table = 'department_type';
    
    protected $fillable = [
        'name',
        'description',
        'status',
        'company_id'
    ];
}
