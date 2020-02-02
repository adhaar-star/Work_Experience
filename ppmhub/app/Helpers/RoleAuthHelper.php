<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\common_route_master;
use Illuminate\Support\Facades\Session;

class RoleAuthHelper
{    
    /**
     * 
     * return all access routes
     */
    public static function getAccessList()
    {  
       // Return all the permission of current User
       return common_route_master::select('common_route_masters.route_path')
                ->where('permission_masters.role_id', Auth::user()->role_id)
                ->join('permission_masters', 'permission_masters.route_id', '=', 'common_route_masters.id')
                ->pluck('route_path')->toArray();              
    }
    
    /**
     * 
     * return access for routes
     */
    public static function hasAccess($route)
    {
      //set for super admin and perticular routes
      return Auth::user()->is_admin == 1 || in_array($route, Session::get('access_array'));
    }
}