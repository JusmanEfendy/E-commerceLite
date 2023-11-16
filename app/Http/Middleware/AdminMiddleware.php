<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Pastikan pengguna adalah admin
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request);
        }
        // dd($request->user()->role);

        // Jika bukan admin, redirect atau berikan pesan akses ditolak
        return redirect('/')->with('Message', 'Selamat Datang Di Toko Jussy.');
    }
}
