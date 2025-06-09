<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FixCookieHeaders
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
        $response = $next($request);

        // Only apply cookie fixes for cross-origin requests
        $origin = $request->header('Origin');
        $isLocalhost = $request->getHost() === 'localhost' || $request->getHost() === '127.0.0.1';
        $isCrossOrigin = $origin && !str_contains($origin, $request->getHost());
        
        // Skip cookie fixing for same-origin requests or localhost
        if (!$isCrossOrigin && !$isLocalhost) {
            return $response;
        }

        // Get all cookies from the response
        $cookies = $response->headers->getCookies();
        
        // Clear existing cookies
        $response->headers->removeCookie('laravel_session');
        $response->headers->removeCookie('XSRF-TOKEN');
        
        // Re-add cookies with proper attributes for cross-origin
        foreach ($cookies as $cookie) {
            $domain = $isLocalhost ? null : $cookie->getDomain();
            $secure = $isCrossOrigin || $request->isSecure();
            $sameSite = $isCrossOrigin ? 'None' : 'Lax';
            
            $response->headers->setCookie(new \Symfony\Component\HttpFoundation\Cookie(
                $cookie->getName(),
                $cookie->getValue(),
                $cookie->getExpiresTime(),
                $cookie->getPath(),
                $domain,
                $secure,
                $cookie->isHttpOnly(),
                false,
                $sameSite
            ));
        }

        // Also fix Set-Cookie headers manually
        $setCookieHeaders = $response->headers->get('Set-Cookie', null, false);
        if ($setCookieHeaders) {
            $fixedHeaders = [];
            foreach ($setCookieHeaders as $header) {
                // Remove existing SameSite and Secure attributes
                $header = preg_replace('/;\s*SameSite=[^;]*/i', '', $header);
                $header = preg_replace('/;\s*Secure/i', '', $header);
                
                // Add appropriate attributes based on request context
                if ($isCrossOrigin) {
                    $header .= '; SameSite=None; Secure';
                } else {
                    $header .= '; SameSite=Lax';
                    if ($request->isSecure()) {
                        $header .= '; Secure';
                    }
                }
                $fixedHeaders[] = $header;
            }
            $response->headers->set('Set-Cookie', $fixedHeaders, false);
        }

        return $response;
    }
}