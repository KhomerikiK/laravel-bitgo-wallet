<?php

namespace Khomeriki\BitgoWallet\Data\Responses;

use Khomeriki\BitgoWallet\Data\Data;

class Webhook extends Data
{
    /**
     * @var string
     */
    public string $id;

    /**
     * @var string
     */
    public string $created;

    /**
     * @var string
     */
    public string $walletId;

    /**
     * @var string
     */
    public string $coin;

    /**
     * @var string
     */
    public string $type;

    /**
     * @var string
     */
    public string $url;

    /**
     * @var int
     */
    public int $version;

    /**
     * @var int
     */
    public int $numConfirmations;

    /**
     * @var int
     */
    public int $successiveFailedAttempts;

    /**
     * @var bool
     */
    public bool $listenToFailureStates;

    /**
     * @var bool
     */
    public bool $allToken;

    /**
     * @var string
     */
    public string $state;
}
