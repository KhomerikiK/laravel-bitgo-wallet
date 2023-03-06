<?php

namespace Khomeriki\BitgoWallet\Data\Responses;

use Khomeriki\BitgoWallet\Data\Data;

class Address extends Data
{
    public string $id;

    public string $address;

    public int $chain;

    public int $index;

    public string $wallet;

    public array $coinSpecific;
}
