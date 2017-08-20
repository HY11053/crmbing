<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuthorityStore
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
        if (User::where('id',Auth::id())->value('groupid')!=3)
        {
            if (Auth::id()==1)
            {
                return $next($request);
            }else{
                return abort(403);
            }

        }else{
            return $next($request);
        }

    }
}
