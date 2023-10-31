<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user(); // Get the authenticated user

                if ($user->status === 'op') {
                    return redirect('/pengguna'); // Redirect "op" users to /pengguna
                } elseif ($user->status === 'rz') {
                    return redirect('/penerima'); // Redirect "rz" users to /penerima
                } elseif ($user->status === 'dm') {
                    return redirect('/bobot'); // Redirect "dm" users to another page
                }
            }
        }

        // If no guard is authenticated, return the original response
        return $next($request);
    }
}