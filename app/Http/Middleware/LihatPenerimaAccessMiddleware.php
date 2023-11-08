<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Gate;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LihatPenerimaAccessMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Gate::allows('view', 'App\Models\LihatPenerima')) {
            return $next($request);
        }

        return redirect('404');
    }
}
