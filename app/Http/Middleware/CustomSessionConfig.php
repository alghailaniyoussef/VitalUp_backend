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
    public function handle(Request $request, Closure $next): Response
    {
        // Determine if this is a cross-origin request
        $origin = $request->header('Origin');
        $isLocalhost = $request->getHost() === 'localhost' || $request->getHost() === '127.0.0.1';
        $isCrossOrigin = $origin && !str_contains($origin, $request->getHost());
        
        // Configure session settings based on request context
        if ($isCrossOrigin) {
            // Cross-origin requests need SameSite=None and Secure=true
            config([
                'session.same_site' => 'none',
                'session.secure' => true,
                'session.domain' => null,
                'session.http_only' => true,
            ]);
        } elseif ($isLocalhost) {
            // Localhost development settings
            config([
                'session.same_site' => 'lax',
                'session.secure' => false,
                'session.domain' => null,
                'session.http_only' => true,
            ]);
        } else {
            // Same-origin requests use default secure settings
            config([
                'session.same_site' => 'lax',
                'session.secure' => $request->isSecure(),
                'session.domain' => null,
                'session.http_only' => true,
            ]);
        }

        return $next($request);
    }
}