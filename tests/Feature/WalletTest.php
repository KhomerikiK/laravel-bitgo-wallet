<?php

use Khomeriki\BitgoWallet\Data\Transfer;
use Khomeriki\BitgoWallet\Data\TransferRecipient;
use Khomeriki\BitgoWallet\Data\TransferRecipients;
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
    $recipient = new TransferRecipient(4934, 'address');
    expect($recipient)
        ->toHaveProperty('amount', 4934)
        ->toHaveProperty('address', 'address');
});

it('can build TransferRecipients object', function () {
    $recipient = new TransferRecipient(4934, 'address');
    $recipient1 = new TransferRecipient(4931, 'address1');
    $transferRecipients = new TransferRecipients(
        $recipient,
        $recipient1
    );
    expect($transferRecipients)->toHaveProperty('recipients', [
        $recipient,
        $recipient1,
    ]);
});
it('can build transfer object', function () {
    $recipient = new TransferRecipient(4934, 'address');
    $recipient1 = new TransferRecipient(4931, 'address1');
    $transferRecipients = new TransferRecipients(
        $recipient,
        $recipient1
    );
    $transfer = new Transfer(
        walletPassphrase: 'test',
        transferRecipients: $transferRecipients,
    );

    expect($transfer)
        ->toHaveProperty('walletPassphrase', 'test')
        ->toHaveProperty('recipients', [
            [
                'amount' => 4934,
                'address' => 'address',
            ],
            [
                'amount' => 4931,
                'address' => 'address1',
            ],
        ]);
});

it('can send transaction', closure: function () {
    $transferRecipients = new TransferRecipients(
        new TransferRecipient(4934, 'address'),
    );
    $transfer = new Transfer(
        walletPassphrase: 'test',
        transferRecipients: $transferRecipients,
    );
    $res = Wallet::init('tbtc', 'wallet-id')->sendTransfer($transfer);
    expect($res)->toBeArray();
});
