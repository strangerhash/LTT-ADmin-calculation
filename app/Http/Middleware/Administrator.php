<?php

namespace App\Http\Middleware;

use Closure;

class Administrator
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
        dd("Inside administrator middleware");
        // if (!$request->user()->hasRole($role)) {
        //     // Redirect...
        // }
        return $next($request);
    }
}
