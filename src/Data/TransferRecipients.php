<?php

namespace Khomeriki\BitgoWallet\Data;

class TransferRecipients
{
    public array $recipients;

    public function __construct(TransferRecipient ...$recipients)
    {
        $this->recipients = $recipients;
    }
}
