<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->role != 'user') {
            if ($request->user()->role === 'admin') {
                return redirect('admin/dashboard');
            } else {
                return redirect('supervisor/dashboard');
            }
        }
        return $next($request);
    }
}
