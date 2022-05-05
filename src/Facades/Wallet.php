<?php

namespace Khomeriki\BitgoWallet\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Khomeriki\BitgoWallet\Wallet
 * @method static init(string $string, string $walletId = null)
 */
class Wallet extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Wallet';
    }
}
