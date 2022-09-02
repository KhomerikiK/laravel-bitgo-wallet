<?php

namespace Khomeriki\BitgoWallet\Data\Responses;

use Khomeriki\BitgoWallet\Data\Data;

class Transfer extends Data
{
    /**
     * @var string
     */
    public string $coin;

    /**
     * @var string
     */
    public string $id;

    /**
     * @var string
     */
    public string $wallet;

    /**
     * @var string
     */
    public string $enterprise;

    /**
     * @var string
     */
    public string $txid;

    /**
     * @var int
     */
    public int $height;

    /**
     * @var string
     */
    public string $heightId;

    /**
     * @var string
     */
    public string $date;

    /**
     * @var string
     */
    public string $type;

    /**
     * @var int
     */
    public int $value;

    /**
     * @var string
     */
    public string $valueString;

    /**
     * @var int
     */
    public int $baseValue;

    /**
     * @var string
     */
    public string $baseValueString;

    /**
     * @var string
     */
    public string $feeString;

    /**
     * @var int
     */
    public int $payGoFee;

    /**
     * @var string
     */
    public string $payGoFeeString;

    /**
     * @var float
     */
    public float $usd;

    /**
     * @var float
     */
    public float $usdRate;

    /**
     * @var string
     */
    public string $state;

    /**
     * @var array
     */
    public array $tags;

    /**
     * @var array
     */
    public array $history;

    /**
     * @var string
     */
    public string $comment;

    /**
     * @var int
     */
    public int $vSize;

    /**
     * @var int
     */
    public int $nSegwitInputs;

    /**
     * @var array
     */
    public array $coinSpecific;

    /**
     * @var string
     */
    public string $sequenceId;

    /**
     * @var array
     */
    public array $entries;

    /**
     * @var bool
     */
    public bool $usersNotified;

    /**
     * @var string
     */
    public string $confirmations;

    /**
     * @var array
     */
    public array $inputs;

    /**
     * @var array
     */
    public array $outputs;
}
