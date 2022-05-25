<?php

namespace Khomeriki\BitgoWallet\Contracts;

use Illuminate\Support\Collection;

interface WalletContract
{
    /**
     * @param string $coin
     * @param string|null $id
     * @return $this
     */
    public function init(string $coin, string $id = null): self;

    /**
     * @param string $label
     * @param string $passphrase
     * @return $this
     */
    public function generate(string $label, string $passphrase): self;

    /**
     * @return $this
     */
    public function get(): self;

    /**
     * @param int $numConfirmations
     * @return $this
     */
    public function addWebhook(int $numConfirmations = 0): self;

    /**
     * @param string|null $label
     * @return $this
     */
    public function generateAddress(string $label = null): self;

    /**
     * @return $this
     */
    public function listTransfers(): self;

    /**
     * @param string $transferId
     * @return array
     */
    public function getTransfer(string $transferId): array;

    /**
     * @param string|null $coin
     * @return Collection
     */
    public function listAll(string $coin = null): Collection;
}
