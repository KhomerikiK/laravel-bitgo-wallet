<?php

use Khomeriki\BitgoWallet\Facades\Wallet;

it('can generate wallet', function () {
    $wallet = $this->wallet->init('tbtc')
        ->generate('testing label', 'testing pass')
        ->generateAddress();

    expect($wallet)
        ->toBeObject()
        ->toHaveProperty('coin', 'tbtc')
        ->toHaveProperty('id')
        ->toHaveProperty('address');
});

it('can generate wallet with webhook', function () {
    $wallet = $this->wallet->init('tbtc')
        ->generate('wallet with webhook', 'testing pass')
        ->addWebhook(0);

    expect($wallet)
        ->toBeObject()
        ->toHaveProperty('coin', 'tbtc')
        ->toHaveProperty('id')
        ->toHaveProperty('address');
});

it('inits wallet correctly', function () {
    $wallet = $this->wallet->init('tbtc', 'walletId');

    expect($wallet)
        ->toBeObject()
        ->toHaveProperty('coin', 'tbtc')
        ->toHaveProperty('id', 'walletId');
});

test('invalid wallet id', function () {
    $wallet = $this->wallet->init('tbtc', 'invalid-walletId')
        ->generateAddress();

    expect($wallet)
        ->toHaveProperty('address', null)
        ->toHaveProperty('error', 'invalid wallet id: invalid-walletId');
});

it('can list all the available wallets', function () {
    $wallets = Wallet::listAll();
    $wallet = $wallets->first();
    expect($wallet)
        ->toBeInstanceOf(\Khomeriki\BitgoWallet\Wallet::class)
        ->toHaveProperties(['coin', 'id', 'address']);
});
