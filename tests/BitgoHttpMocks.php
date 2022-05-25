<?php

namespace Khomeriki\BitgoWallet\Tests;

use Illuminate\Support\Facades\Http;

trait BitgoHttpMocks
{
    public static function setupMocks()
    {
        $walletData = [
            'id' => '627e1ca8f763d80007d9549b8589c31a',
            'coin' => 'tbtc',
            'receiveAddress' => [
                'id' => '627e1ca8f763d80007d954b9a4a2477d',
                'address' => '2NGMqpJLQRYjvGkp9oM3Rgejf1a5tceDzCK',
            ],
        ];
        Http::preventStrayRequests();
        $testingUrl = config('bitgo.testnet_api_url') .'/'. config('bitgo.v2_api_prefix');
        $expressUrl = config('bitgo.express_api_url') .'/'. config('bitgo.v2_api_prefix');
        Http::fake([
            "{$expressUrl}tbtc/wallet/generate" => Http::response($walletData),
            "{$testingUrl}wallets*" => Http::response(['wallets' => [$walletData]]),

            "{$expressUrl}tbtc/wallet/invalid-walletId/address" => Http::response([
                'address' => null,
                'error' => 'invalid wallet id: invalid-walletId',
            ]),
            "{$expressUrl}tbtc/wallet/627e1ca8f763d80007d9549b8589c31a/webhooks" => Http::response([]),
            "{$expressUrl}ping" => Http::response([]),
            "{$testingUrl}ping" => Http::response([]),
            "{$testingUrl}user/me" => Http::response([
                'user' => 'fake',
            ]),
        ]);
    }
}
