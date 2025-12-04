<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOnboarding
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip check for onboarding routes and logout
        if ($request->routeIs('onboarding.*') || $request->routeIs('logout')) {
            return $next($request);
        }

        // Check if user is authenticated and not onboarded
        if (auth()->check() && !auth()->user()->is_onboarded) {
            return redirect()->route('onboarding.index');
        }

        return $next($request);
    }
}
