<?php

namespace Khomeriki\BitgoWallet;

use Illuminate\Support\ServiceProvider;

class BitgoServiceProvider extends ServiceProvider
{
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/bitgo.php', 'bitgo'
        );
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/bitgo.php' => config_path('bitgo.php'),
        ], 'bitgo-config');
    }
}
