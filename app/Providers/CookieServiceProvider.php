<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Cookie;

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
                    // Force SameSite=None and Secure=true for ALL cookies
                    return parent::make($name, $value, $minutes, $path, $domain, true, $httpOnly, $raw, 'none');
                }
                
                public function forever($name, $value, $path = null, $domain = null, $secure = null, $httpOnly = true, $raw = false, $sameSite = null)
                {
                    return $this->make($name, $value, 2628000, $path, $domain, true, $httpOnly, $raw, 'none');
                }
                
                public function forget($name, $path = null, $domain = null)
                {
                    return $this->make($name, null, -2628000, $path, $domain, true, false, false, 'none');
                }
            };
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Force session configuration very early
        config([
            'session.same_site' => 'none',
            'session.secure' => true,
            'session.domain' => null,
            'session.http_only' => true,
        ]);
        
        // Override the session manager to force cookie settings
        $this->app->extend('session', function ($session, $app) {
            $session->getSessionConfig()['same_site'] = 'none';
            $session->getSessionConfig()['secure'] = true;
            $session->getSessionConfig()['domain'] = null;
            return $session;
        });
    }
}