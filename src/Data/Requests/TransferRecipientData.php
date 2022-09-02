<?php

namespace Khomeriki\BitgoWallet\Data\Requests;

use Khomeriki\BitgoWallet\Data\Data;

final class TransferRecipientData extends Data
{
    /**
     * @var int
     */
    public int $amount;

    /**
     * @var string
     */
    public string $address;
}
