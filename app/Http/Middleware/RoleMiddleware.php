<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Support\Facades\Auth;

// class RoleMiddleware
// {
//     public function handle(Request $request, Closure $next, $role)
//     {
//         if (Auth::check() && Auth::user()->role === $role) {
//             return $next($request);
//         }
//         return redirect('/');
//     }
// }

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // if (Auth::check() && Auth::user()->roles->contains('role_name', $role)) {
        //     return $next($request);
        // }
        if (Auth::check() && Auth::user()->role && Auth::user()->role->role_name === $role) {
            return $next($request);
        }
        return redirect('/');
    }
}
