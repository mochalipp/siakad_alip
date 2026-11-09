<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekUser
{
    // Middleware level: Admin (1) & User (2)
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && in_array(Auth::user()->level, [1, 2])) {
            return $next($request);
        }

        return redirect('/home')->with('pesan', 'Anda tidak memiliki akses User !');
    }
}
