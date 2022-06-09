<?php

namespace Khomeriki\BitgoWallet\Data;

class Transfer
{
    public string $walletPassphrase;
    public array $recipients;
    public int $feeRate;

    /**
     * Transfer constructor.
     * @param string $walletPassphrase
     * @param array<TransferRecipient> $transferRecipients
     * @param int $feeRate
     */
    public function __construct(
        string $walletPassphrase,
        array $transferRecipients,
        int $feeRate = 0,
    ) {
        $this->walletPassphrase = $walletPassphrase;
        $this->feeRate = $feeRate;
        $this->recipients = array_map(function ($recipient) {
            return (array)$recipient;
        }, $transferRecipients);
    }
}
