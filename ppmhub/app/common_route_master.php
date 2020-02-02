<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class common_route_master extends Model
{

    protected $table = 'common_route_masters';
    protected $primaryKey = 'id';
    protected $fillable = [
        'route_path',
        'parent',
    ];

    function roles()
    {
        return $this->belongsToMany('App\roles_master', 'permission_masters', 'route_id', 'role_id');
    }

    public function parent()
    {
    return $this->belongsTo('App\common_route_master', 'parent');



    }

    public function children_rec()
    {

        return $this->hasMany('App\common_route_master', 'parent', 'id')->select('id', 'parent', 'route_path as text', DB::raw('"" as checked'));
    }

    public function children()
    {
        return $this->children_rec()->with('children');
    }

}
