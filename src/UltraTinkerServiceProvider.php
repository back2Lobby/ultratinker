<?php

namespace Back2Future\UltraTinker;

use Illuminate\Support\ServiceProvider;

class UltraTinkerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ultratinker.init', function ($app) {
            return $app['Back2Future\UltraTinker\Commands\UltraTinkerInit'];
        });
        $this->commands('ultratinker.init');
    }
}
