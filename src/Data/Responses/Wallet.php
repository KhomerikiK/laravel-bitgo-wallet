<?php

namespace Khomeriki\BitgoWallet\Data\Responses;

use Khomeriki\BitgoWallet\Data\Data;

class Wallet extends Data
{
    /**
     * @var ?string
     */
    public ?string $id;

    /**
     * Ids of users with access to the wallet
     *
     * @var array
     */
    public array $users;

    /**
     * Name of the blockchain the wallet is on
     *
     * @var string
     */
    public string $coin;

    /**
     * Name the user assigned to the wallet
     *
     * @var string
     */
    public string $label;

    /**
     * Number of signatures required for the wallet to send
     *
     * @var int
     */
    public int $m;

    /**
     * Number of signers on the wallet
     *
     * @var int
     */
    public int $n;

    /**
     * @var array<string>
     */
    public array $keys;

    /**
     * @var array
     */
    public array $keySignatures;

    /**
     * Tags set on the wallet
     *
     * @var array<string>
     */
    public array $tags;

    /**
     * @var array
     */
    public array $receiveAddress;

    /**
     * Wallet balance as number
     *
     * @var int
     */
    public int $balance;

    /**
     * Wallet balance as string
     *
     * @var string
     */
    public string $balanceString;

    /**
     * Confirmed wallet balance as number
     *
     * @var int
     */
    public int $confirmedBalance;

    /**
     * Confirmed wallet balance as string
     *
     * @var string
     */
    public string $confirmedBalanceString;

    /**
     * Spendable wallet balance as number
     *
     * @var int
     */
    public int $spendableBalance;

    /**
     * Spendable wallet balance as string
     *
     * @var string
     */
    public string $spendableBalanceString;

    /**
     * Flag which indicates the wallet has been deleted
     *
     * @var bool
     */
    public bool $deleted;

    /**
     * Flag for identifying cold wallets
     *
     * @var bool
     */
    public bool $isCold;

    /**
     * Freeze state (used to stop the wallet from spending)
     *
     * @var array
     */
    public array $freezy;

    /**
     * Flag for disabling wallet transaction notifications
     *
     * @var bool
     */
    public bool $disableTransactionNotifications;

    /**
     * Admin data (wallet policies)
     *
     * @var array
     */
    public array $admin;

    /**
     * Flag for allowing signing with backup key
     *
     * @var int
     */
    public int $approvalsRequired;

    /**
     * Pending approvals on the wallet
     *
     * @var array
     */
    public array $pendingApprovals;

    /**
     * Flag for allowing signing with backup key
     *
     * @var bool
     */
    public bool $allowBackupKeySigning;

    /**
     * Coin-specific data
     *
     * @var array
     */
    public array $coinSpecific;

    /**
     * @var array<string>
     */
    public array $clientFlags;

    /**
     * Flag indicating whether this wallet's user key is recoverable with the passphrase held by the user.
     *
     * @var bool
     */
    public bool $recoverable;

    /**
     * Time when this wallet was created
     *
     * @var string date-time
     */
    public string $startDate;

    /**
     * Flag indicating that this wallet is large (more than 100,000 addresses).
     * If this is set, some APIs may omit properties which are expensive to calculate
     * for wallets with many addresses (for example, the total address counts returned by the List Addresses API).
     *
     * @var bool
     */
    public bool $hasLargeNumberOfAddresses;

    /**
     * Custom configuration options for this wallet
     *
     * @var array
     */
    public array $config;
}
