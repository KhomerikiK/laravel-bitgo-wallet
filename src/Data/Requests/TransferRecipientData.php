<?php

namespace Khomeriki\BitgoWallet\Data\Requests;

use Khomeriki\BitgoWallet\Data\Data;

final class TransferRecipientData extends Data
{
    public int $amount;

    public string $address;
}
