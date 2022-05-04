<?php

namespace Khomeriki\BitgoWallet;

class Wallet extends Bitgo
{
    public string $coin;
    public ?array $wallet;
    public ?string $walletId;
    public ?string $address;

    public function __construct()
    {
        $this->coin = config('bitgo.default_coin');
    }

    /**
     * @param string $coin
     * @param string|null $walletId
     * @return Wallet
     */
    public function init(string $coin, string $walletId = null): self
    {
        $this->walletId = $walletId;
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
        $endpoint = "{$this->coin}/wallet/generate";
        $wallet = $this->httpPostExpress($endpoint, [
            'label'=> $label,
            'passphrase' => $passphrase
        ]);
        $this->wallet = $wallet;
        $this->walletId = $wallet['id'] ?? null;
        $this->address = $wallet['receiveAddress']['address'] ?? null;
        return $this;
    }

    /**
     * @return Wallet
     */
    public function get(): self
    {
        $endpoint = "{$this->coin}/wallet/{$this->walletId}";
        $wallet = $this->httpGet($endpoint);
        $this->wallet = $wallet;
        $this->walletId = $wallet['id'] ?? null;
        $this->address = $wallet['receiveAddress']['address'] ?? null;
        return $this;
    }

    /**
     * @param int $numConfirmations
     * @return Wallet
     */
    public function addWebhook(int $numConfirmations = 0): self
    {
        $endpoint = "{$this->coin}/wallet/{$this->walletId}/webhooks";
        $this->httpPostExpress($endpoint, [
            'type'=> 'transfer',
            'url' => config('bitgo.webhook_callback_url'),
            'numConfirmations' => $numConfirmations
        ]);
        return $this;
    }

    /**
     * @param string|null $label
     * @return Wallet
     */
    public function generateAddress(string $label = null): self
    {
        $endpoint = "{$this->coin}/wallet/{$this->walletId}/address";
        $address = $this->httpPostExpress($endpoint, ['label' => $label]);
        $this->address = $address['address']??null;
        return $this;
    }
}
