<?php

namespace Zizou86\Unifonic;

use Illuminate\Support\ServiceProvider;


class UnifonicServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/unifonic.php' => config_path('unifonic.php'),
        ], 'config');
    }


    /**
     * Register the application services.
     *
     * @return void
     */

    public function register()
    {
        $this->app->singleton('unifonic', function () {
            return new UnifonicManager;
        });
    }

}