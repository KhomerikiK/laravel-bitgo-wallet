<?php

namespace Khomeriki\BitgoWallet\Data;

class TransferRecipient
{
    public function __construct(
        public int $amount,
        public string $address
    ) {
    }
}
