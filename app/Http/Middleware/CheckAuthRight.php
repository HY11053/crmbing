<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuthRight
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
        if(empty(User::where('id',Auth::id())->value('groupid')) && User::where('id',Auth::id())->value('usertype')>1)
        {
            return abort(403);
        }
        return $next($request);
    }
}
