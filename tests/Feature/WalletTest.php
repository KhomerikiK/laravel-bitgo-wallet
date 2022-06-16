<?php

use Khomeriki\BitgoWallet\Data\TransferData;
use Khomeriki\BitgoWallet\Data\TransferRecipientData;
use Khomeriki\BitgoWallet\Facades\Wallet;

it('can generate wallet', function () {
    $wallet = Wallet::init('tbtc')
        ->generate('testing label', 'testing pass')
        ->generateAddress();

    expect($wallet)
        ->toBeObject()
        ->toHaveProperty('coin', 'tbtc')
        ->toHaveProperty('id')
        ->toHaveProperty('address');
});

it('can generate wallet with webhook', function () {
    $wallet = Wallet::init('tbtc')
        ->generate('wallet with webhook', 'testing pass')
        ->addWebhook(0);

    expect($wallet)
        ->toBeObject()
        ->toHaveProperty('coin', 'tbtc')
        ->toHaveProperty('id')
        ->toHaveProperty('address');
});

it('inits wallet correctly', function () {
    $wallet = Wallet::init('tbtc', 'walletId');
    expect($wallet)
        ->toBeObject()
        ->toHaveProperty('coin', 'tbtc')
        ->toHaveProperty('id', 'walletId');
});

it('can list all the available wallets', function () {
    $wallets = Wallet::listAll();
    $wallet = $wallets->first();
    expect($wallet)
        ->toBeInstanceOf(\Khomeriki\BitgoWallet\Wallet::class)
        ->toHaveProperties(['coin', 'id', 'address']);
});


it('can build TransferRecipient object', function () {
    $recipient = TransferRecipientData::fromArray([
        'amount' => 4934,
        'address' => 'address',
    ]);
    expect($recipient)
        ->toHaveProperty('amount', 4934)
        ->toHaveProperty('address', 'address');
});

it('can build transfer object', function () {
    $transferData = TransferData::fromArray([
        'walletPassphrase' => 'test',
        'recipients' => [
            TransferRecipientData::fromArray([
                'amount' => 4934,
                'address' => 'address',
            ]),
            TransferRecipientData::fromArray([
                'amount' => 4931,
                'address' => 'address1',
            ]),
        ],
    ]);

    expect($transferData)
        ->toHaveProperty('walletPassphrase', 'test')
        ->toHaveProperty('recipients', [
            TransferRecipientData::fromArray([
                'amount' => 4934,
                'address' => 'address',
            ]),
            TransferRecipientData::fromArray([
                'amount' => 4931,
                'address' => 'address1',
            ]),
        ]);
});

it('can send transaction', closure: function () {
    $transferData = TransferData::fromArray([
        'walletPassphrase' => 'test',
        'recipients' => [
            TransferRecipientData::fromArray([
                'amount' => 333,
                'address' => 'dddd',
            ]),
            TransferRecipientData::fromArray([
                'amount' => 333,
                'address' => 'dddd',
            ]),
        ],
    ]);

    $res = Wallet::init('tbtc', 'wallet-id')->sendTransfer($transferData);
    expect($res)->toBeArray();
});
