<?php

namespace Ventrec\LaravelEntitySyncClient;

use Illuminate\Support\ServiceProvider;

class LaravelEntitySyncClientProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../publishes/config/laravelEntitySyncEndpoint.php' => config_path('laravelEntitySyncEndpoint.php'),
        ], 'config');

        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
    }
}
