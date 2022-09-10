<?php

namespace Khomeriki\BitgoWallet\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static all()
 * @method static getByCoin(string $string)
 */
class ExchangeRate extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Khomeriki\BitgoWallet\ExchangeRate::class;
    }
}
