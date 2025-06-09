<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;

class SetCsrfCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // Always set cookies with SameSite=None for cross-origin requests in production
        if ($request->session()) {
            $config = config('session');
            
            // Force CSRF cookie with SameSite=None and Secure=true
            $csrfCookie = new Cookie(
                'XSRF-TOKEN',
                $request->session()->token(),
                time() + 60 * ($config['lifetime'] ?? 120),
                $config['path'] ?? '/',
                null, // domain = null for cross-origin
                true, // secure = true (required for SameSite=None)
                false, // httpOnly = false (XSRF token needs to be accessible by JS)
                false,
                'none' // SameSite = none for cross-origin requests
            );
            
            $response->headers->setCookie($csrfCookie);
            
            // Also ensure session cookie has correct SameSite setting
            $sessionName = $config['cookie'] ?? 'laravel_session';
            $sessionCookie = new Cookie(
                $sessionName,
                $request->session()->getId(),
                time() + 60 * ($config['lifetime'] ?? 120),
                $config['path'] ?? '/',
                null, // domain = null for cross-origin
                true, // secure = true (required for SameSite=None)
                $config['http_only'] ?? true,
                false,
                'none' // SameSite = none for cross-origin requests
            );
            
            $response->headers->setCookie($sessionCookie);
        }
        
        return $response;
    }
}