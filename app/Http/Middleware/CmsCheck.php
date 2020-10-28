<?php

namespace App\Http\Middleware;

use Closure;

class CmsCheck
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
        if(auth()->user() && auth()->user()->cms)
        {
            return $next($request);
        } 

        return redirect('/');
    }
}
