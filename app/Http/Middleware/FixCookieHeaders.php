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
        
        // Get all Set-Cookie headers
        $cookies = $response->headers->getCookies();
        
        // Clear existing cookies properly
        foreach ($cookies as $cookie) {
            $response->headers->removeCookie($cookie->getName(), $cookie->getPath(), $cookie->getDomain());
        }
        
        // Re-add cookies with forced SameSite=None and Secure=true
        foreach ($cookies as $cookie) {
            $response->headers->setCookie(
                new \Symfony\Component\HttpFoundation\Cookie(
                    $cookie->getName(),
                    $cookie->getValue(),
                    $cookie->getExpiresTime(),
                    $cookie->getPath(),
                    null, // Force domain to null for cross-origin
                    true, // Force secure
                    $cookie->isHttpOnly(),
                    $cookie->isRaw(),
                    'none' // Force SameSite=none
                )
            );
        }
        
        // Also manually fix Set-Cookie headers in case some are set directly
        $setCookieHeaders = $response->headers->get('Set-Cookie', null, false);
        if ($setCookieHeaders) {
            $fixedHeaders = [];
            foreach ($setCookieHeaders as $header) {
                // Remove existing SameSite and Secure attributes
                $header = preg_replace('/;\s*SameSite=[^;]*/i', '', $header);
                $header = preg_replace('/;\s*Secure/i', '', $header);
                
                // Add our forced attributes
                $header .= '; Secure; SameSite=None';
                $fixedHeaders[] = $header;
            }
            
            // Replace all Set-Cookie headers
            $response->headers->set('Set-Cookie', $fixedHeaders, false);
        }
        
        return $response;
    }
}