<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
use Illuminate\Database\Eloquent\SoftDeletes;

class Planningunit extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'planning_unit';
    protected $fillable = [
        'name',
        'description',
        'status',
        'company_id'
    ];
   
}