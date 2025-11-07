<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * $roles bisa satu string atau array.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
        }

        $userRole = strtolower($user->role->nama_role ?? '');
        $roles = array_map('strtolower', $roles);

        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized'); // atau redirect ke halaman lain
        }

        return $next($request);
    }
}
        