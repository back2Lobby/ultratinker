<?php

namespace Back2Future\TinkerPlus;

use Illuminate\Support\ServiceProvider;

class TinkerPlusServiceProvider extends ServiceProvider
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
        $this->app->singleton('tinkerplus.init', function ($app) {
            return $app['Back2Future\TinkerPlus\Commands\TinkerPlusInit'];
        });
        $this->commands('tinkerplus.init');
    }
}
