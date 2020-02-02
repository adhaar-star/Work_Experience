<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personresponsible extends Model
{
    protected $table = 'person_responsible';
    
    protected $fillable = [
        'name',
        'description', 
        'status',
        'company_id'
    ];
}
