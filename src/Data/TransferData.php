<?php

namespace Khomeriki\BitgoWallet\Data;

final class TransferData extends Data
{
    /**
     * @var string
     */
    public string $walletPassphrase;

    /**
     * @var array<TransferRecipientData>
     */
    public array $recipients;

    /**
     * @var int
     */
    public int $feeRate;
}
