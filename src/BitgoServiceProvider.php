<?php

namespace Khomeriki\BitgoWallet;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Khomeriki\BitgoWallet\Adapters\BitgoAdapter;
use Khomeriki\BitgoWallet\Contracts\BitgoAdapterContract;

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
            __DIR__.'/../config/bitgo.php',
            'bitgo'
        );
        $this->app->bind(BitgoAdapterContract::class, BitgoAdapter::class);

        $this->app->bind('Wallet', function () {
            return new Wallet();
        });
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
