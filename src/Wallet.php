<?php

namespace Khomeriki\BitgoWallet;

use Illuminate\Support\Collection;
use Khomeriki\BitgoWallet\Contracts\BitgoAdapterContract;
use Khomeriki\BitgoWallet\Contracts\WalletContract;

class Wallet implements WalletContract
{
    /**
     * @var string|null
     */
    public ?string $id;
    /**
     * @var string
     */
    public string $coin;
    /**
     * @var array|null
     */
    public ?array $wallet;
    /**
     * @var string|null
     */
    public ?string $address;
    /**
     * @var array
     */
    public array $transfers;
    /**
     * @var string|null
     */
    public ?string $error;

    protected BitgoAdapterContract $adapter;

    public function __construct()
    {
        $this->adapter = app(BitgoAdapterContract::class);
        $this->coin = config('bitgo.default_coin');
        $this->transfers = [];
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
        $this->wallet = $wallet;
        $this->id = $wallet['id'] ?? null;
        $this->address = $wallet['receiveAddress']['address'] ?? null;
        $this->error = $wallet['error'] ?? null;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function get(): self
    {
        $wallet = $this->adapter->getWallet($this->coin, $this->id);
        $this->id = $wallet['id'] ?? null;
        $this->address = $wallet['receiveAddress']['address'] ?? null;
        $this->error = $wallet['error'] ?? null;

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

        return $wallets->map(function ($element) {
            $wallet = new Wallet();
            $wallet->id = $element['id'];

            return $wallet;
        });
    }
}
