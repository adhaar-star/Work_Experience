<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
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
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest(\App\Models\Helper::adminBase());
            }
        }

        $user = $this->auth->user();

        $a = $request->route()->getAction();
        $c = explode('@', $a['controller']);

      
        if ($user->role === 'vendor' && $user->store == false && empty($user->store) && $c[0] !== 'App\Http\Controllers\Backend\StoreController') {
            return redirect()->to(\App\Models\Helper::adminBase('/store/create'))->with(['message' => ['text' => 'Please setup you store first to continue.', 'class' => 'alert-warning']]);
        }

        return $next($request);
    }
}
