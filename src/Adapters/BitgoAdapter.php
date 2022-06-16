<?php

namespace Khomeriki\BitgoWallet\Adapters;

use Illuminate\Http\Client\Response;
use Khomeriki\BitgoWallet\Contracts\BitgoAdapterContract;
use Khomeriki\BitgoWallet\Data\TransferData;
use Khomeriki\BitgoWallet\Traits\InteractsWithBitgo;

class BitgoAdapter implements BitgoAdapterContract
{
    use InteractsWithBitgo;
    public const API_PREFIX = "api/v2/";

    /**
     * @inheritDoc
     */
    public function me(): Response
    {
        return $this->httpGet(self::API_PREFIX.'user/me');
    }

    /**
     * @inheritDoc
     */
    public function pingExpress(): Response
    {
        return $this->httpGetExpress(self::API_PREFIX.'ping');
    }

    /**
     * @inheritDoc
     */
    public function ping(): Response
    {
        return $this->httpGet(self::API_PREFIX.'ping');
    }

    /**
     * @inheritDoc
     */
    public function generateWallet(string $coin, string $label, string $passphrase): ?array
    {
        $endpoint = "$coin/wallet/generate";
        $response = $this->httpPostExpress(self::API_PREFIX.$endpoint, [
            'label' => $label,
            'passphrase' => $passphrase,
        ]);

        return $response->json();
    }

    /**
     * @inheritDoc
     */
    public function getWallet(string $coin, ?string $walletId): ?array
    {
        $endpoint = "$coin/wallet/{$walletId}";
        $response = $this->httpGet(self::API_PREFIX.$endpoint);

        return $response->json();
    }

    /**
     * @inheritDoc
     */
    public function generaAddressOnWallet(string $coin, string $walletId, string $label = null): ?array
    {
        $endpoint = "$coin/wallet/$walletId/address";
        $response = $this->httpPostExpress(self::API_PREFIX.$endpoint, ['label' => $label]);

        return $response->json();
    }

    /**
     * @inheritDoc
     */
    public function addWalletWebhook(string $coin, string $walletId, int $numConfirmations = 0, string $callbackUrl = null): ?array
    {
        $callbackUrl = $callbackUrl ?: config('bitgo.webhook_callback_url');
        $endpoint = "$coin/wallet/$walletId/webhooks";
        $response = $this->httpPostExpress(self::API_PREFIX.$endpoint, [
            'type' => 'transfer',//TODO::should be dynamic
            'url' => $callbackUrl,
            'numConfirmations' => $numConfirmations,
        ]);

        return $response->json();
    }

    /**
     * @inheritDoc
     */
    public function getWalletTransfers(string $coin, string $walletId): ?array
    {
        $endpoint = "$coin/wallet/$walletId/transfer";
        $response = $this->httpGet(self::API_PREFIX.$endpoint);

        return $response->json();
    }

    /**
     * @inheritDoc
     */
    public function getWalletTransfer(string $coin, string $walletId, string $transferId): ?array
    {
        $endpoint = "$coin/wallet/$walletId/transfer/$transferId";
        $response = $this->httpGet(self::API_PREFIX.$endpoint);

        return $response->json();
    }

    /**
     * @inheritDoc
     */
    public function getAllWallets(string $coin = null, bool $expandBalance = true): ?array
    {
        $endpoint = "wallets?expandBalance=$expandBalance&coin=$coin";
        $response = $this->httpGet(self::API_PREFIX.$endpoint);

        return $response->json();
    }

    /**
     * @inheritDoc
     */
    public function sendTransactionToMany(string $coin, string $walletId, TransferData $transfer): ?array
    {
        $body = (array)$transfer;
        $endpoint = "$coin/wallet/$walletId/sendmany";
        $response = $this->httpPostExpress(self::API_PREFIX.$endpoint, $body);

        return $response->json();
    }

    /**
     * @inheritDoc
     */
    public function getMaximumSpendable(string $coin, string $walletId): ?array
    {
        $endpoint = "$coin/wallet/$walletId/maximumSpendable";
        $response = $this->httpGet(self::API_PREFIX.$endpoint);

        return $response->json();
    }

    /**
     * @inheritDoc
     */
    public function listTraWalletTransfers(string $coin, string $walletId): ?array
    {
        $endpoint = "$coin/wallet/$walletId/transfer";
        $response = $this->httpGet(self::API_PREFIX.$endpoint);

        return $response->json();
    }
}
