<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Session\Middleware\StartSession;
use Symfony\Component\HttpFoundation\Cookie;

class CookieServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Override cookie configuration for cross-origin requests
        $this->app->resolving(EncryptCookies::class, function ($middleware) {
            // Force SameSite=None for all cookies in production
            $middleware->disableFor([]);
        });

        // Override session configuration
        $this->app->booted(function () {
            config([
                'session.same_site' => 'none',
                'session.secure' => true,
                'session.domain' => null,
            ]);
        });

        // Cookie options are handled through Laravel's config system above
    }
}