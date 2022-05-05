<?php

namespace Khomeriki\BitgoWallet;

use Khomeriki\BitgoWallet\Contracts\WalletContract;

class Wallet extends Bitgo implements WalletContract
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

    public function __construct()
    {
        $this->coin = config('bitgo.default_coin');
        $this->transfers = [];
    }

    /**
     * @param string $coin
     * @param string|null $id
     * @return Wallet
     */
    public function init(string $coin, string $id = null): self
    {
        $this->id = $id;
        $this->coin = $coin;

        return $this;
    }

    /**
     * @param string $label
     * @param string $passphrase
     * @return Wallet
     */
    public function generate(string $label, string $passphrase): self
    {
        $wallet = self::generateWallet($this->coin, $label, $passphrase);
        $this->wallet = $wallet;
        $this->id = $wallet['id'] ?? null;
        $this->address = $wallet['receiveAddress']['address'] ?? null;
        $this->error = $wallet['error'] ?? null;

        return $this;
    }

    /**
     * @return Wallet
     */
    public function get(): self
    {
        $wallet = self::getWallet($this->coin, $this->id);
        $this->id = $wallet['id'] ?? null;
        $this->address = $wallet['receiveAddress']['address'] ?? null;
        $this->error = $wallet['error'] ?? null;

        return $this;
    }

    /**
     * @param int $numConfirmations
     * @param string|null $callbackUrl
     * @return Wallet
     */
    public function addWebhook(int $numConfirmations = 0, string $callbackUrl = null): self
    {
        $webhook = self::addWalletWebhook($this->coin, $this->id, $numConfirmations, $callbackUrl);
        $this->error = $webhook['error'] ?? null;

        return $this;
    }

    /**
     * @param string|null $label
     * @return Wallet
     */
    public function generateAddress(string $label = null): self
    {
        $address = self::generaAddressOnWallet($this->coin, $this->id, $label);
        $this->error = $address['error'] ?? null;
        $this->address = $address['address'] ?? null;

        return $this;
    }

    /**
     * @return $this
     */
    public function listTransfers(): self
    {
        $transfers = $this->getWalletTransfers($this->coin, $this->id);
        $this->transfers = $transfers['transfers'] ?? [];

        return $this;
    }

    /**
     * @param string $transferId
     * @return array
     */
    public function getTransfer(string $transferId): array
    {
        return $this->getWalletTransfer($this->coin, $this->id, $transferId);
    }
}
