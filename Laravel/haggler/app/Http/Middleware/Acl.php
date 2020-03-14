<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class ACL
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->check()) {

            $ac = $request->route()->getAction();

           

            $exploded = explode('@', $ac['controller']);

            $c = @$exploded[0];
            $c_base = basename($c);
            $a = @$exploded[1];

            if (!$this->accessRights($c_base, $a)) {
                return response('Unauthorized.', 401);
            }

            return $next($request);
        }

        

        return $next($request);
    }

    public function accessRights($c, $a) {

        $acl = [
            
                'CategoryController' => [
                    'admin' => '*',
                ],

                'DealCategoryController' => [
                    'admin' => '*',
                ],

                'SliderController' => [
                    'admin' => '*',
                ],

                'UserController' => [
                    'admin' => '*',
                ],

                'SettingController' => [
                    'admin' => '*',
                ],
            
        ];

        $role = $this->auth->user()->role;

        // access true in case controller is not registered in acl
        if ( !isset($acl[$c]) ) return true;

        $c_layers = $acl[$c];

        // return true in case controller has wildcard access
        if ($c_layers == '*') return true;

        // return access false is layer has no current user registration
        if (!isset($c_layers[$role])) return false;

        $user_layers = $c_layers[$role];

        // return if user role has wildcard access to controller actions
        if ($user_layers == '*') return true;

        // return false if action not found on user roles layer
        if (!in_array($a, $user_layers)) return false;



    }
}
