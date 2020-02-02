<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Costcentretype extends Model
{
    protected $table = 'cost_centre_type';
    
    protected $fillable = [
        'name',
        'status',
        'company_id'
    ];
}
