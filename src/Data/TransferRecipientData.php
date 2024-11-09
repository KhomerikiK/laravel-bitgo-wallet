<?php

namespace Khomeriki\BitgoWallet\Data;

use Khomeriki\BitgoWallet\Data\Data;

final class TransferRecipientData extends Data
{
    public int $amount;

    public string $address;
}
