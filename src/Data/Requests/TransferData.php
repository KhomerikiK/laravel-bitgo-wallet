<?php

namespace Khomeriki\BitgoWallet\Data\Requests;

use Khomeriki\BitgoWallet\Data\Data;

final class TransferData extends Data
{
    public string $walletPassphrase;

    /**
     * @var array<TransferRecipientData>
     */
    public array $recipients;

    public int $feeRate;
}
