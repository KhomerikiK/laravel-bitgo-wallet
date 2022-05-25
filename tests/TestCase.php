<?php

namespace Khomeriki\BitgoWallet\Tests;

use Khomeriki\BitgoWallet\Adapters\BitgoAdapter;
use Khomeriki\BitgoWallet\BitgoServiceProvider;
use Khomeriki\BitgoWallet\Contracts\BitgoAdapterContract;
use Khomeriki\BitgoWallet\Contracts\WalletContract;
use Khomeriki\BitgoWallet\Wallet;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public BitgoAdapterContract $adapter;
    public WalletContract $wallet;
    use BitgoHttpMocks;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adapter = new BitgoAdapter();
        $this->wallet = new Wallet();
        if (config('bitgo.use_mocks')) {
            self::setupMocks();
        }
    }

    protected function getPackageProviders($app)
    {
        return [
            BitgoServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
