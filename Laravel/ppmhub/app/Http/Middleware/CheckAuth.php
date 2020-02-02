<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;
use App\Helpers\RoleAuthHelper;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::check())
        {
            Session::flash('failure_add', 'Your not Logged In, Please login to proceed.');
            return redirect('/admin');
        }
        // Set Roles In Session
        $request->session()->put('access_array', RoleAuthHelper::getAccessList());        
        return $next($request);
    }    
}