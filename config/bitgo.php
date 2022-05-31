<?php

return [
    'use_mocks' => env('BITGO_USE_MOCKS', true),//for tests

    'testnet' => env('BITGO_TESTNET', true),

    'api_key' => env('BITGO_API_KEY'),
    'v2_api_prefix' => 'api/v2/',
    'testnet_api_url'=>'https://app.bitgo-test.com',
    'mainnet_api_url'=>'https://app.bitgo.com',
    'express_api_url' => env('BITGO_EXPRESS_API_URL'),

    'default_coin' => env('BITGO_DEFAULT_COIN', 'tbtc'),
    'webhook_callback_url' => env('BITGO_WEBHOOK_CALLBACK'),
];
