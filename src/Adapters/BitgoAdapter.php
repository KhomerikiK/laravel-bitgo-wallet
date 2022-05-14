<?php

namespace Khomeriki\BitgoWallet\Adapters;

use Illuminate\Http\Client\Response;
use Khomeriki\BitgoWallet\Contracts\BitgoAdapterContract;
use Khomeriki\BitgoWallet\Traits\InteractsWithBitgo;

class BitgoAdapter implements BitgoAdapterContract
{
    use InteractsWithBitgo;

    /**
     * @inheritDoc
     */
    public function me(): Response
    {
        return $this->httpGet('user/me');
    }

    /**
     * @inheritDoc
     */
    public function pingExpress(): Response
    {
        return $this->httpGetExpress('ping');
    }

    /**
     * @inheritDoc
     */
    public function ping(): Response
    {
        return $this->httpGet('ping');
    }

    /**
     * @inheritDoc
     */
    public function generateWallet(string $coin, string $label, string $passphrase): ?array
    {
        $endpoint = "$coin/wallet/generate";
        $response = $this->httpPostExpress($endpoint, [
            'label' => $label,
            'passphrase' => $passphrase,
        ]);

        return $response->json();
    }

    /**
     * @inheritDoc
     */
    public function getWallet(string $coin, string $walletId): ?array
    {
        $endpoint = "$coin/wallet/{$walletId}";
        $response = $this->httpGet($endpoint);

        return $response->json();
    }

    /**
     * @inheritDoc
     */
    public function generaAddressOnWallet(string $coin, string $walletId, string $label = null): ?array
    {
        $endpoint = "$coin/wallet/$walletId/address";
        $response = $this->httpPostExpress($endpoint, ['label' => $label]);

        return $response->json();
    }

    /**
     * @inheritDoc
     */
    public function addWalletWebhook(string $coin, string $walletId, int $numConfirmations = 0, string $callbackUrl = null): ?array
    {
        $callbackUrl = $callbackUrl ?: config('bitgo.webhook_callback_url');
        $endpoint = "$coin/wallet/$walletId/webhooks";
        $response = $this->httpPostExpress($endpoint, [
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
        $response = $this->httpGet($endpoint);

        return $response->json();
    }

    /**
     * @inheritDoc
     */
    public function getWalletTransfer(string $coin, string $walletId, string $transferId): ?array
    {
        $endpoint = "$coin/wallet/$walletId/transfer/$transferId";
        $response = $this->httpGet($endpoint);

        return $response->json();
    }
}
