<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permission_master extends Model
{
    protected $table = 'permission_masters';
    //protected $primaryKey = 'id';
    protected $fillable = [
        'route_id',
        'role_id',
        'method',
        'permission',
        'parent',
      
    ];
}
