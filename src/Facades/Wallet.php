<?php

namespace Khomeriki\BitgoWallet\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Khomeriki\BitgoWallet\Wallet
 */
class Wallet extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Wallet';
    }
}
