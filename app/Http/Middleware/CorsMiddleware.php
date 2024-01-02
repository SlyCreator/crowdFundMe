<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, OPTIONS, post, get')
            ->header('Access-Control-Max-Age', '3600')
            ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, X-Auth-Token')
            ->header('Access-Control-Allow-Credentials', 'true');
    }

}
