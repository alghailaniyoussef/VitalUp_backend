<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Response;

class CookieServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Override the cookie jar to force SameSite=None
        $this->app->extend('cookie', function ($cookieJar, $app) {
            return new class($app['request'], $app['config']['app.key']) extends CookieJar {
                public function make($name, $value, $minutes = 0, $path = null, $domain = null, $secure = null, $httpOnly = true, $raw = false, $sameSite = null)
                {
                    // Force SameSite=None and Secure=true for cross-origin requests
                    return parent::make($name, $value, $minutes, $path, $domain, true, $httpOnly, $raw, 'none');
                }
            };
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Force session configuration early
        config([
            'session.same_site' => 'none',
            'session.secure' => true,
            'session.domain' => null,
        ]);

        // Override response macro to ensure all cookies have correct SameSite
        Response::macro('withCookieOverride', function ($cookie) {
            if (is_string($cookie)) {
                $cookie = cookie($cookie);
            }
            
            // Force SameSite=None and Secure=true
            $cookie = $cookie->withSecure(true)->withSameSite('none');
            
            return $this->withCookie($cookie);
        });
    }
}