<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Check if the user's role matches the required role
        if ($request->user()->role !== $role) {
            // Redirect to the dashboard if roles don't match
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
