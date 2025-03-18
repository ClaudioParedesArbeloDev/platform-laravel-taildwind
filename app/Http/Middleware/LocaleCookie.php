<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class LocaleCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->cookie('locale', app()->getLocale());
        app()->setLocale($locale);
        return $next($request);
    }
}
