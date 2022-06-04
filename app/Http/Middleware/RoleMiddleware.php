<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if(Auth::user()->id === User::SUPPER_ADMIN_ID) {
            return $next($request);
        }
        $roles = is_array($role) ? $role : explode('|', $role);
        if (!Auth::user()->hasRole($roles)) {
            return redirect('admin');
        }

        return $next($request);
    }
}
