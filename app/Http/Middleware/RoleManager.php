<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (Auth::check()) {
            $lastActivity = session('last_activity');
            $timeout = 3600; // 1 jam dalam detik

            // 1. Cek Durasi Inaktivitas
            if ($lastActivity && (time() - $lastActivity > $timeout)) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                // Redirect ke login dengan pesan session habis
                return redirect()->route('login')->with('SA-error', 'Sesi Anda telah berakhir. Silakan login kembali.');
            }

            // 2. Perbarui Timestamp Aktivitas Terakhir
            session(['last_activity' => time()]);

            // 3. Cek Role (Logika Asli Kamu)
            if (in_array(Auth::user()->role, $roles)) {
                return $next($request);
            }
        }

        // Jika tidak login atau role tidak sesuai, lempar ke halaman error
        return redirect()->route('auth.errors'); 
    }
}
