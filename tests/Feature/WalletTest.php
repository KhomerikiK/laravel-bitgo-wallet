<?php

use Khomeriki\BitgoWallet\Facades\Wallet;

it('can generate wallet', function () {
    $wallet = Wallet::init('tbtc')
        ->generate('testing label', 'testing pass');

    expect($wallet)
        ->toBeObject()
        ->toHaveProperty('coin', 'tbtc')
        ->toHaveProperty('id')
        ->toHaveProperty('address');
});

it('can generate wallet with webhook', function (){
    $wallet = Wallet::init('tbtc')
        ->generate('wallet with webhook', 'testing pass')
        ->addWebhook(0);

    expect($wallet)
        ->toBeObject()
        ->toHaveProperty('coin', 'tbtc')
        ->toHaveProperty('id')
        ->toHaveProperty('address');
});

it('inits wallet correctly', function (){
    $wallet = Wallet::init('tbtc', 'walletId');

    expect($wallet)
        ->toBeObject()
        ->toHaveProperty('coin', 'tbtc')
        ->toHaveProperty('id', 'walletId');
});

test('invalid wallet id', function (){
    $wallet = Wallet::init('tbtc', 'invalid-walletId')
        ->generateAddress();

    expect($wallet)
        ->toHaveProperty('address', null)
        ->toHaveProperty('error', 'invalid wallet id: invalid-walletId');
});
