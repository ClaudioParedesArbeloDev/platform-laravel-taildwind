<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Manejar una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado y tiene el rol "admin"
        if (!$request->user() || !$request->user()->roles()->where('name', 'admin')->exists()) {
            abort(403, 'Unauthorized'); // Retornar error 403 si no es admin
        }

        return $next($request);
    }
}