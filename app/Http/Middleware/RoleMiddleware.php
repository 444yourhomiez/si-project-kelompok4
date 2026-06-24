<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        if (! auth()->check()) {
            abort(403);
        }
        $userRole = strtolower(auth()->user()->role);
        $allowed  = array_map('strtolower', $roles);
        if (! in_array($userRole, $allowed)) {
            abort(403);
        }
        if ($userRole === 'anggota' && auth()->user()->status !== 'disetujui') {
            return redirect()->route('menunggu');
        }
        return $next($request);
    }
}
