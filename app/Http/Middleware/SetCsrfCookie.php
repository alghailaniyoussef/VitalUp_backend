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
        
        // Only set CSRF cookie for stateful domains
        $statefulDomains = config('sanctum.stateful', []);
        $origin = $request->header('Origin');
        $referer = $request->header('Referer');
        
        $isStatefulRequest = false;
        foreach ($statefulDomains as $domain) {
            if ($origin && str_contains($origin, $domain)) {
                $isStatefulRequest = true;
                break;
            }
            if ($referer && str_contains($referer, $domain)) {
                $isStatefulRequest = true;
                break;
            }
        }
        
        if ($isStatefulRequest && $request->session()) {
            $config = config('session');
            
            // Create CSRF cookie with SameSite=None for cross-origin requests
            $cookie = new Cookie(
                'XSRF-TOKEN',
                $request->session()->token(),
                time() + 60 * ($config['lifetime'] ?? 120),
                $config['path'] ?? '/',
                null, // domain = null for cross-origin
                $config['secure'] ?? true,
                false, // httpOnly = false (XSRF token needs to be accessible by JS)
                false,
                'none' // SameSite = none for cross-origin requests
            );
            
            $response->headers->setCookie($cookie);
        }
        
        return $response;
    }
}