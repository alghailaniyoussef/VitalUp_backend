<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Symfony\Component\HttpFoundation\Cookie;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Exclude these routes from CSRF protection
        // They are handled by Sanctum's stateful middleware
    ];

    /**
     * Determine if the request has a URI that should pass through CSRF verification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function inExceptArray($request)
    {
        // Don't exclude API routes - let them use CSRF protection with Sanctum
        return parent::inExceptArray($request);
    }

    /**
     * Add the CSRF token to the response cookies.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function addCookieToResponse($request, $response)
    {
        $config = config('session');

        if ($response instanceof \Illuminate\Http\Response) {
            $response->headers->setCookie(
                new Cookie(
                    'XSRF-TOKEN',
                    $request->session()->token(),
                    $this->availableAt(60 * $config['lifetime']),
                    $config['path'],
                    null, // Force domain to null for cross-origin
                    true, // secure
                    false, // httpOnly
                    false, // raw
                    'none' // sameSite
                )
            );
        }

        return $response;
    }
}