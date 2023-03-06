<?php

namespace Khomeriki\BitgoWallet\Data\Responses;

use Khomeriki\BitgoWallet\Data\Data;

class Webhook extends Data
{
    public string $id;

    public string $created;

    public string $walletId;

    public string $coin;

    public string $type;

    public string $url;

    public int $version;

    public int $numConfirmations;

    public int $successiveFailedAttempts;

    public bool $listenToFailureStates;

    public bool $allToken;

    public string $state;
}
