<?php

namespace App\Http\Middleware;

use Closure;
use App\user;
use Auth;

class AdminRoutes
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
       if(Auth::id()){
            if(Auth::user()->user_type == 0){
                return redirect ('AccessNotAllowed');
        }
         else{
            return $next($request);
         }
        }
    }
}
