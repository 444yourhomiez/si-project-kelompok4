<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (! auth()->check() || strtolower(auth()->user()->role) != strtolower($role)) {
            abort(403);
        }
        if ($role === 'anggota' && auth()->user()->status !== 'disetujui') {
            return redirect()->route('menunggu');
        }
        return $next($request);
    }
}
