<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekAdmin
{
    // Middleware level 1: Admin — Part 3
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->level == 1) {
            return $next($request);
        }

        return redirect('/home')->with('pesan', 'Anda tidak memiliki akses Admin !');
    }
}
