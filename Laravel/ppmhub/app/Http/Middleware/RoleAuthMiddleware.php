<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Helpers\RoleAuthHelper;

class RoleAuthMiddleware
{

   /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
   public function handle($request, Closure $next) {
                 
      $routeName = $request->route()->getName();
      
      if (!$request->ajax() and !empty($routeName)) {
         if (!RoleAuthHelper::hasAccess($routeName)) {
            return ($request->ajax()) ? response()->json(['error' => 'You Are Not Authorized to Perform this Action'], 403) : abort(403, 'You are not unauthorized to access this page.');
         }                  
      }
      return $next($request);
   }
}
