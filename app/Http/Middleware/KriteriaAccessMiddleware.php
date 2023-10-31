<?php

namespace App\Http\Middleware;

use App\Models\Kriteria;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class KriteriaAccessMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Gate::allows('view', 'App\Models\Kriteria')) {
            return $next($request);
        }

        return redirect('404');
    }
}
