<?php

namespace App\Http\Middleware;

use App\Models\SubKriteria;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class SubKriteriaAccessMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if (Gate::allows('view', 'App\Models\SubKriteria')) {
            return $next($request);
        }

        return redirect('404');
    }
}
