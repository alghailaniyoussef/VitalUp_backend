<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class CustomSessionConfig
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        // Force session configuration for cross-origin requests
        Config::set('session.same_site', 'none');
        Config::set('session.secure', true);
        Config::set('session.http_only', true);
        
        // Set domain to null for cross-origin requests
        Config::set('session.domain', null);
        
        return $next($request);
    }
}