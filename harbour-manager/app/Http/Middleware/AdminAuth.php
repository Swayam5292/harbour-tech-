<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('is_admin')) {
            return redirect('/login.html');
        }

        return $next($request);
    }
}
