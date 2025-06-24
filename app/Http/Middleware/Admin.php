<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Auth
        if (Auth::check()) {
            // uer
            $user = Auth::user();

            if ($user->hasRole(['super-admin', 'admin'])) {
                return $next($request);
            }
            // 403
            abort(403, 'User does not have correct Role');
        }
        // 401
        abort(401);
    }
}
