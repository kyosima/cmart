<?php

namespace Devt\Payme;

use Illuminate\Support\ServiceProvider;

class PaymeServiceProvider extends ServiceProvider
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
