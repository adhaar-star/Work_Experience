<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Models\User;

class API
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
        if ($this->user($request) == false) {
            return response()->json(['error' => 'Unauthorized 401.', 'data' => [], 'success' => false, 'messages' => []]);
        }

        return $next($request);
    }

    protected function user($request) {

        $api_token = $request->get('api_token');

        if (empty($api_token) && strlen($api_token) < 40) {
            return false;
        }

        $user = User::where('api_token', $api_token)->first();

        if (!$user)  return false;

        $this->auth->setUser($user);


        return true;

    }
}
