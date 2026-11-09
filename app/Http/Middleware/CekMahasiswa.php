<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekMahasiswa
{
    // Middleware level: Admin (1) & Mahasiswa (3)
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && in_array(Auth::user()->level, [1, 3])) {
            return $next($request);
        }

        return redirect('/home')->with('pesan', 'Anda tidak memiliki akses Mahasiswa !');
    }
}
