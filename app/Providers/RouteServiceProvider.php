<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        $this->routes(function () {
            // API routes
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace) // optional; you can remove if using auto-discovery
                ->group(base_path('routes/api.php'));

            // Web routes
            Route::middleware('web')
                ->namespace($this->namespace) // optional
                ->group(base_path('routes/web.php'));
        });
    }
}
