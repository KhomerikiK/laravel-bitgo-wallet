<?php

namespace Khomeriki\BitgoWallet;

use Illuminate\Support\Collection;
use Khomeriki\BitgoWallet\Contracts\BitgoAdapterContract;
use Khomeriki\BitgoWallet\Contracts\WalletContract;
use Khomeriki\BitgoWallet\Data\Transfer;

class Wallet implements WalletContract
{
    public ?string $id;
    public string $coin;
    public ?array $wallet;
    public ?string $address;
    public ?array $receiveAddress;
    public ?int $balance;
    public ?int $confirmedBalance;
    public ?int $spendableBalance;
    public array $transfers;
    public ?string $error;

    protected BitgoAdapterContract $adapter;

    public function __construct()
    {
        $this->adapter = app(BitgoAdapterContract::class);
        $this->coin = config('bitgo.default_coin');
        $this->transfers = [];
    }

    private function setProperties(array $propertyList)
    {
        foreach ($propertyList as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function init(string $coin, string $id = null): self
    {
        $this->id = $id;
        $this->coin = $coin;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function generate(string $label, string $passphrase): self
    {
        $wallet = $this->adapter->generateWallet($this->coin, $label, $passphrase);
        $this->setProperties($wallet);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function get(): self
    {
        $wallet = $this->adapter->getWallet($this->coin, $this->id);
        $this->setProperties($wallet);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addWebhook(int $numConfirmations = 0, string $callbackUrl = null): self
    {
        $webhook = $this->adapter->addWalletWebhook($this->coin, $this->id, $numConfirmations, $callbackUrl);
        $this->error = $webhook['error'] ?? null;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function generateAddress(string $label = null): self
    {
        $address = $this->adapter->generaAddressOnWallet($this->coin, $this->id, $label);
        $this->error = $address['error'] ?? null;
        $this->address = $address['address'] ?? null;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function listTransfers(): self
    {
        $transfers = $this->adapter->getWalletTransfers($this->coin, $this->id);
        $this->transfers = $transfers['transfers'] ?? [];

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getTransfer(string $transferId): array
    {
        return $this->adapter->getWalletTransfer($this->coin, $this->id, $transferId);
    }

    /**
     * @inheritDoc
     */
    public function listAll(string $coin = null): Collection
    {
        $wallets = collect($this->adapter->getAllWallets($coin)['wallets'] ?? []);

        return $wallets->map(callback: function ($element) {
            $wallet = new self();
            $wallet->setProperties($element);

            return $wallet;
        });
    }

    /**
     * @inheritDoc
     */
    public function sendTransfer(Transfer $transfer): ?array
    {
        return $this->adapter->sendTransactionToMany(
            $this->coin,
            $this->id,
            $transfer
        );
    }

    /**
     * @inheritDoc
     */
    public function getMaximumSpendable(): ?array
    {
        return $this->adapter->getMaximumSpendable($this->coin, $this->id);
    }

    /**
     * @inheritDoc
     */
    public function getTransfers(): ?array
    {
        return  $this->adapter->getWalletTransfers($this->coin, $this->id);
    }
}
