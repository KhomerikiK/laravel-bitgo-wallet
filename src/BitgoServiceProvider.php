<?php

namespace Khomeriki\BitgoWallet;

use Illuminate\Support\Facades\Http;
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
        $this->app->bind('Wallet', function () {
            return new Wallet();
        });

        $this->mergeConfigFrom(
            __DIR__.'/../config/bitgo.php',
            'bitgo'
        );
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $apiUrl = config('bitgo.testnet') ? config('bitgo.testnet_api_url') : config('bitgo.mainnet_api_url');
        $apiPrefix = config('bitgo.v2_api_prefix');
        $expressApiUrl = config('bitgo.express_api_url');

        $this->publishes([
            __DIR__.'/../config/bitgo.php' => config_path('bitgo.php'),
        ], 'bitgo-config');

        Http::macro('bitgoApi', function () use ($apiUrl, $apiPrefix) {
            return Http::withHeaders([
                'Authorization' => "Bearer " . config('bitgo.api_key'),
            ])->baseUrl("{$apiUrl}/{$apiPrefix}");
        });

        Http::macro('bitgoExpressApi', function () use ($expressApiUrl, $apiPrefix) {
            return Http::withHeaders([
                'Authorization' => "Bearer " . config('bitgo.api_key'),
            ])->baseUrl("{$expressApiUrl}/{$apiPrefix}");
        });
    }
}
