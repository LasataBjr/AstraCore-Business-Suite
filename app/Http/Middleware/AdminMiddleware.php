<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if (! auth()->check()) { // User is not authenticated
            return redirect()->route('login');
        }

        if (auth()->user()->role !== 'admin') { // User is authenticated but not an admin
            abort(403, 'Unauthorized to access this page.');
        }

        return $next($request);
    }
}
