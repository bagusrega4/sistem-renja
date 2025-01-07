<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
<<<<<<< HEAD
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $allowedRoles = collect($roles)
            ->flatMap(function ($role) {
                return explode(',', $role);
            })
            ->map(function ($role) {
                return (int) $role;
            })
            ->toArray();

        if (in_array(Auth::user()->id_role, $allowedRoles)) {
=======
        if (Auth::check() && in_array(Auth::user()->role, $roles)) {
>>>>>>> e801f44bb8043adf54c86d10e519d78cfea5ec56
            return $next($request);
        }

        return redirect()->route('error.unauthorized');
    }
}
