<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('Middleware customer check:', ['authenticated' => auth('cus')->check()]);

        if (auth('cus')->check()) {
            return $next($request);
        }
        \Log::info('Middleware customer is called');
        return redirect()->route('account.login');

    }
}
