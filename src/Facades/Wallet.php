<?php

namespace Khomeriki\BitgoWallet\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Khomeriki\BitgoWallet\Wallet init(string $coin, string $id = null)
 * @method static \Illuminate\Support\Collection listAll(string $coin = null, ?array $params = []))
 */
class Wallet extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Khomeriki\BitgoWallet\Wallet::class;
    }
}
