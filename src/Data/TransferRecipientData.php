<?php

namespace Khomeriki\BitgoWallet\Data;

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
