<?php

namespace Ventrec\LaravelEntitySyncClient;

use Illuminate\Support\ServiceProvider;

class LaravelEntitySyncClientProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../publishes/config/laravelEntitySync.php' => config_path('laravelEntitySync.php'),
        ], 'config');
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
