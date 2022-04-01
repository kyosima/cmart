<?php

namespace Devt\Ninepay;

use Illuminate\Support\ServiceProvider;

class NinepayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        include __DIR__.'/routes/routes.php';
    }
}
