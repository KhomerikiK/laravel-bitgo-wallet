<?php

namespace Khomeriki\BitgoWallet;

use Illuminate\Support\Arr;
use Khomeriki\BitgoWallet\Contracts\BitgoAdapterContract;

class ExchangeRate
{
    protected BitgoAdapterContract $adapter;

    /**
     * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected mixed $coin;

    public function __construct(BitgoAdapterContract $adapter)
    {
        $this->adapter = $adapter;
        $this->coin = config('bitgo.default_coin');
    }

    /**
     * @return array|null
     */
    public function all(): ?array
    {
        return $this->adapter->getExchangeRates();
    }

    /**
     * @param  string|null  $coin
     * @return array|null
     */
    public function getByCoin(?string $coin = null): ?array
    {
        $rates = $this->adapter->getExchangeRates($coin);

        return Arr::first($rates['marketData']);
    }
}
