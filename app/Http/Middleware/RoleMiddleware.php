<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Jika role user tidak sama dengan parameter role yang diminta rute
        if ($request->user()->role !== $role) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin ke halaman ini.');
        }

        return $next($request);
    }
}
