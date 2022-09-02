<?php

namespace Khomeriki\BitgoWallet\Data\Responses;

use Khomeriki\BitgoWallet\Data\Data;

class KeySignature extends Data
{
    /**
     * Signature for the backup pub
     *
     * @var string
     */
    public string $backupPub;

    /**
     * Signature for the BitGo pub
     *
     * @var string
     */
    public string $bitgoPub;
}
