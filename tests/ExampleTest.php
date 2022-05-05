<?php

use Khomeriki\BitgoWallet\Facades\Wallet;

it('can test', function () {
    Wallet::init('tbtc');
    expect(true)->toBeTrue();
});
