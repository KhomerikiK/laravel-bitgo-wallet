<?php

namespace Khomeriki\BitgoWallet\Data;

class Transfer
{
    public string $walletPassphrase;
    public array $recipients;
    public int $feeRate;

    public function __construct(
        string $walletPassphrase,
        TransferRecipients $transferRecipients,
        int $feeRate = 0
    ) {
        $this->walletPassphrase = $walletPassphrase;
        $this->feeRate = $feeRate;
        $this->recipients = array_map(function ($recipient) {
            return (array)$recipient;
        }, $transferRecipients->recipients);
    }
}
