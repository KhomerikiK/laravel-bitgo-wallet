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
            return new Wallet(
                app(BitgoAdapterContract::class)
            );
        });

        $this->app->bind('ExchangeRate', function () {
            return new ExchangeRate(
                app(BitgoAdapterContract::class)
            );
        });
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

        $this->registerHttpMacros();
    }

    public function registerHttpMacros()
    {
        $apiUrl = config('bitgo.testnet') ? config('bitgo.testnet_api_url') : config('bitgo.mainnet_api_url');

        Http::macro('bitgoApi', function () use ($apiUrl) {
            return Http::withHeaders([
                'Authorization' => 'Bearer '.config('bitgo.api_key'),
            ])->baseUrl("{$apiUrl}");
        });

        Http::macro('bitgoExpressApi', function () {
            return Http::withHeaders([
                'Authorization' => 'Bearer '.config('bitgo.api_key'),
            ])->baseUrl(config('bitgo.express_api_url'));
        });
    }
}
