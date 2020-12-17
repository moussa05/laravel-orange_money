<?php

namespace Orange\Orange_Money;

use  Illuminate\Support\ServiceProvider;


class OrangeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views','orange');
        resolve(\Illuminate\Routing\UrlGenerator::class)->forceScheme('https');
        \URL::forceScheme('https');
    }

    public function register()
    {
        // register our controller
        $this->app->make('Orange\Orange_Money\Http\Controllers\OrangeController');

    }

}