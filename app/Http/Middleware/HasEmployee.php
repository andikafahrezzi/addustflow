<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class HasEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        $employee = Employee::where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if (!$employee) {
            return redirect()->route('dashboard')
                ->with('error', 'Akun Anda belum terdaftar sebagai karyawan.');
        }

        return $next($request);
    }
}
