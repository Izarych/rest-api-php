<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Guards\HeaderGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->app['auth']->extend('header_id_guard', function ($app) {
            return new HeaderGuard(
                $app->make(UserProvider::class),
                $app['request']
            );
        });
    }
}
