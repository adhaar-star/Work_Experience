<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projecttype extends Model
{
    protected $table = 'project_type';
    
    protected $fillable = [
        'name',
        'status',
        'company_id'
    ];
}
