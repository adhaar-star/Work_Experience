<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfoliotype extends Model
{
    protected $table = 'portfolio_type';
    
    protected $fillable = [
        'name',
        'status',
        'company_id'
    ];
}
