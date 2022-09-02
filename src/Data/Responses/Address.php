<?php

namespace Khomeriki\BitgoWallet\Data\Responses;

use Khomeriki\BitgoWallet\Data\Data;

class Address extends Data
{
    /**
     * @var string
     */
    public string $id;

    /**
     * @var string
     */
    public string $address;

    /**
     * @var int
     */
    public int $chain;

    /**
     * @var int
     */
    public int $index;

    /**
     * @var string
     */
    public string $wallet;

    /**
     * @var array
     */
    public array $coinSpecific;
}
