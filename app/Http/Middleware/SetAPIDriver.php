<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetAPIDriver
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        auth()->setDefaultDriver('api');
        return $next($request);
    }
}
