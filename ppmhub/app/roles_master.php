<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class roles_master extends Model
{

    protected $table = 'roles_masters';
    protected $primaryKey = 'id';
    protected $fillable = [
        'role_name',
        'changed_by',
        'created_by',
        'created_at',
        'changed_at',
        'company_id'
    ];

    public function register()
    {
        return $this->belongsTo('App\register', 'role_id', 'id');
    }

    function routes()
    {
        return $this->belongsToMany('App\common_route_master','permission_masters','role_id','route_id')->select('id');
    }

}
