<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekDosen
{
    // Middleware level: Admin (1) & Dosen (4)
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && in_array(Auth::user()->level, [1, 4])) {
            return $next($request);
        }

        return redirect('/home')->with('pesan', 'Anda tidak memiliki akses Dosen !');
    }
}
