<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class LastActivedAtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            Auth::user()->logLastActivedAt();
        }

        return $next($request);
    }
}
