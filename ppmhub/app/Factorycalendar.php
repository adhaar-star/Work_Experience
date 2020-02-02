<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factorycalendar extends Model
{
    protected $table = 'factory_calendar';
    
    protected $fillable = [
        'name',
        'status',
        'company_id',
        'description'
    ];
}
