<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Cookie;

class CsrfCookieController extends Controller
{
    /**
     * Return an empty response simply to trigger the storage of the CSRF cookie in the browser.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // Ensure session is started
        if (!$request->session()->isStarted()) {
            $request->session()->start();
        }

        // Generate CSRF token
        $token = $request->session()->token();
        
        // Create response
        $response = new Response('', 204);
        
        // Set XSRF-TOKEN cookie for cross-origin requests
        $cookie = new Cookie(
            'XSRF-TOKEN',
            $token,
            time() + (config('session.lifetime') * 60),
            config('session.path', '/'),
            null, // domain - null for cross-origin
            config('session.secure', true), // secure
            false, // httpOnly - must be false for JS access
            false, // raw
            config('session.same_site', 'none') // sameSite
        );
        
        $response->headers->setCookie($cookie);
        
        // Add CORS headers
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        
        // Log for debugging
        \Log::info('CSRF Cookie Generated', [
            'token' => $token,
            'session_id' => $request->session()->getId(),
            'origin' => $request->header('Origin'),
            'cookie_domain' => null,
            'cookie_secure' => config('session.secure', true),
            'cookie_same_site' => config('session.same_site', 'none')
        ]);
        
        return $response;
    }
}