<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->admin == User::IS_ADMINISTRATOR) {
                return $next($request);
            } else {
                return redirect('admin/login')->with('notify', 'Đăng nhập không thành công.');
            }
        } else {
            return redirect('admin/login');
        }
    }
}
