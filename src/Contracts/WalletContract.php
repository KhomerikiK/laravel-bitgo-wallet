<?php

namespace Khomeriki\BitgoWallet\Contracts;

use Illuminate\Support\Collection;
use Khomeriki\BitgoWallet\Data\Requests\TransferData;
use Khomeriki\BitgoWallet\Data\Responses\Address;
use Khomeriki\BitgoWallet\Data\Responses\Transfer;
use Khomeriki\BitgoWallet\Data\Responses\Webhook;

interface WalletContract
{
    /**
     * @param  string  $coin
     * @param  string|null  $id
     * @return $this
     */
    public function init(string $coin, string $id = null): self;

    /**
     * @param  string  $label
     * @param  string  $passphrase
     * @return $this
     */
    public function generate(string $label, string $passphrase, array $options = []): self;

    /**
     * @return $this
     */
    public function get(): self;

    /**
     * @param  int  $numConfirmations
     * @return Webhook
     */
    public function addWebhook(int $numConfirmations = 0): Webhook;

    /**
     * @param  string|null  $label
     * @return Address
     */
    public function generateAddress(string $label = null): Address;

    /**
     * @param  string  $transferId
     * @return Transfer
     */
    public function getTransfer(string $transferId): Transfer;

    /**
     * @param  string|null  $coin
     * @param  array|null  $params
     * @return Collection
     */
    public function listAll(string $coin = null, ?array $params = []): Collection;

    /**
     * @param  TransferData  $transfer
     * @return array|null
     */
    public function sendTransfer(TransferData $transfer): ?array;

    /**
     * @return array|null
     */
    public function getMaximumSpendable(): ?array;

    /**
     * @return array|null
     */
    public function getTransfers(): ?array;
}
