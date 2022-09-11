<?php

namespace Khomeriki\BitgoWallet\Contracts;

use Illuminate\Http\Client\Response;
use Khomeriki\BitgoWallet\Data\Requests\GenerateWallet;
use Khomeriki\BitgoWallet\Data\Requests\TransferData;

interface BitgoAdapterContract
{
    /**
     * @return Response
     */
    public function me(): Response;

    /**
     * @param  string|null  $coin
     * @return array|null
     */
    public function getExchangeRates(string $coin = null): ?array;

    /**
     * @return Response
     */
    public function pingExpress(): Response;

    /**
     * @return Response
     */
    public function ping(): Response;

    /**
     * @param  string  $coin
     * @param  GenerateWallet  $generateWalletData
     * @return array|null
     */
    public function generateWallet(string $coin, GenerateWallet $generateWalletData): ?array;

    /**
     * @param  string  $coin
     * @param  string|null  $walletId
     * @return array|null
     */
    public function getWallet(string $coin, ?string $walletId): ?array;

    /**
     * @param  string  $coin
     * @param  string  $walletId
     * @param  ?string  $label
     * @return array|null
     */
    public function generaAddressOnWallet(string $coin, string $walletId, string $label = null): ?array;

    /**
     * @param  string  $coin
     * @param  string  $walletId
     * @param  int  $numConfirmations
     * @param  string|null  $callbackUrl
     * @return array|null
     */
    public function addWalletWebhook(string $coin, string $walletId, int $numConfirmations = 0, string $callbackUrl = null): ?array;

    /**
     * @param  string  $coin
     * @param  string  $walletId
     * @param  array|null  $params
     * @return array|null
     */
    public function getWalletTransfers(string $coin, string $walletId, ?array $params = []): ?array;

    /**
     * @param  string  $coin
     * @param  string  $walletId
     * @param  string  $transferId
     * @return array|null
     */
    public function getWalletTransfer(string $coin, string $walletId, string $transferId): ?array;

    /**
     * @param  string|null  $coin
     * @param  array|null  $params
     * @return array|null
     */
    public function getAllWallets(string $coin = null, ?array $params = []): ?array;

    /**
     * @param  string  $coin
     * @param  string  $walletId
     * @param  TransferData  $transfer
     * @return array|null
     */
    public function sendTransactionToMany(string $coin, string $walletId, TransferData $transfer): ?array;

    /**
     * @param  string  $coin
     * @param  string  $walletId
     * @return array|null
     */
    public function getMaximumSpendable(string $coin, string $walletId): ?array;

    /**
     * @param  string  $coin
     * @param  string  $walletId
     * @return array|null
     */
    public function listTraWalletTransfers(string $coin, string $walletId): ?array;
}
