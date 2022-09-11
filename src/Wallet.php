<?php

namespace Khomeriki\BitgoWallet;

use Illuminate\Support\Collection;
use Khomeriki\BitgoWallet\Contracts\BitgoAdapterContract;
use Khomeriki\BitgoWallet\Contracts\WalletContract;
use Khomeriki\BitgoWallet\Data\Requests\GenerateWallet;
use Khomeriki\BitgoWallet\Data\Requests\TransferData;
use Khomeriki\BitgoWallet\Data\Responses\Address;
use Khomeriki\BitgoWallet\Data\Responses\Transfer;
use Khomeriki\BitgoWallet\Data\Responses\Wallet as WalletData;
use Khomeriki\BitgoWallet\Data\Responses\Webhook;

class Wallet extends WalletData implements WalletContract
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

    protected BitgoAdapterContract $adapter;

    public function __construct(BitgoAdapterContract $adapter)
    {
        $this->adapter = $adapter;
        $this->coin = config('bitgo.default_coin');
    }

    private function setProperties(array $propertyList)
    {
        foreach ($propertyList as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function init(string $coin, string $id = null): self
    {
        $this->coin = $coin;
        $this->id = $id;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function generate(string $label, string $passphrase, array $options = []): self
    {
        $options = array_merge([
            'label' => $label,
            'passphrase' => $passphrase,
        ], $options);

        $generateWalletData = GenerateWallet::fromArray($options);

        $wallet = $this->adapter->generateWallet($this->coin, $generateWalletData);
        $this->setProperties($wallet);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function get(): self
    {
        $wallet = $this->adapter->getWallet($this->coin, $this->id);
        $this->setProperties($wallet);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function addWebhook(int $numConfirmations = 0, string $callbackUrl = null): Webhook
    {
        $webhook = $this->adapter->addWalletWebhook($this->coin, $this->id, $numConfirmations, $callbackUrl);

        return Webhook::fromArray($webhook);
    }

    /**
     * {@inheritDoc}
     */
    public function generateAddress(string $label = null): Address
    {
        $address = $this->adapter->generaAddressOnWallet($this->coin, $this->id, $label);

        return Address::fromArray($address);
    }

    /**
     * {@inheritDoc}
     */
    public function getTransfer(string $transferId): Transfer
    {
        $transfer = $this->adapter->getWalletTransfer($this->coin, $this->id, $transferId);

        return Transfer::fromArray($transfer);
    }

    /**
     * {@inheritDoc}
     */
    public function listAll(string $coin = null, ?array $params = []): Collection
    {
        $wallets = collect($this->adapter->getAllWallets($coin, $params)['wallets'] ?? []);

        return $wallets->map(callback: function ($element) {
            $wallet = app('Wallet');
            $wallet->setProperties($element);

            return $wallet;
        });
    }

    /**
     * {@inheritDoc}
     */
    public function sendTransfer(TransferData $transfer): ?array
    {
        return $this->adapter->sendTransactionToMany(
            $this->coin,
            $this->id,
            $transfer
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getMaximumSpendable(): ?array
    {
        return $this->adapter->getMaximumSpendable($this->coin, $this->id);
    }

    /**
     * {@inheritDoc}
     */
    public function getTransfers(?array $params = []): ?array
    {
        $walletTransfers = $this->adapter->getWalletTransfers($this->coin, $this->id, $params);

        return array_map(function ($item) {
            return Transfer::fromArray($item);
        }, $walletTransfers['transfers']);
    }
}
