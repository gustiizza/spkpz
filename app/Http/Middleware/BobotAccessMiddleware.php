<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class BobotAccessMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if (Gate::allows('view', 'App\Models\Bobot')) {
            return $next($request);
        }

        return redirect('404');
    }
}
