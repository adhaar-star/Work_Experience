<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phasetype extends Model
{
    protected $table = 'phase_type';
    
    protected $fillable = [
        'name',
        'status',
    ];
}
