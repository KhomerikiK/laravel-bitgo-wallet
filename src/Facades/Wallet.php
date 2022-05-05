<?php

namespace Khomeriki\BitgoWallet\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Khomeriki\BitgoWallet\Wallet
 * @mixin \Khomeriki\BitgoWallet\Wallet
 */
class Wallet extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Khomeriki\BitgoWallet\Wallet::class;
    }
}
