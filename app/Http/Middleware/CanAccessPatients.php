<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CanAccessPatients
{
    /**
     * Allow access only to super admins (is_admin = true)
     * or section users (is_admin = false but section is set).
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || (!$user->isSuperAdmin() && !$user->isSectionUser())) {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}
