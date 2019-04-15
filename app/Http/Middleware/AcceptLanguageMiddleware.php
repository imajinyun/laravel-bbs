<?php

namespace App\Http\Middleware;

use App;
use Closure;

class AcceptLanguageMiddleware
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
        if ($language = $request->header('accept-language')) {
            App::setLocale($language);
        }

        return $next($request);
    }
}
