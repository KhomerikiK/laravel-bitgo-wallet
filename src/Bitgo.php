<?php

namespace Khomeriki\BitgoWallet;

use Illuminate\Http\Client\Response;
use Khomeriki\BitgoWallet\Contracts\BitgoContract;
use Khomeriki\BitgoWallet\Traits\InteractsWithBitgo;

class Bitgo implements BitgoContract
{
    use InteractsWithBitgo;

    /**
     * @return Response
     */
    public function me(): Response
    {
        return self::httpGet('user/me');
    }

    /**
     * @return Response
     */
    public function pingExpress(): Response
    {
        return self::httpGetExpress('ping');
    }

    /**
     * @return Response
     */
    public function ping(): Response
    {
        return self::httpGet('ping');
    }

    /**
     * @param string $coin
     * @param string $label
     * @param string $passphrase
     * @return array|null
     */
    public function generateWallet(string $coin, string $label, string $passphrase): ?array
    {
        $endpoint = "$coin/wallet/generate";
        $response = self::httpPostExpress($endpoint, [
            'label' => $label,
            'passphrase' => $passphrase,
        ]);

        return $response->json();
    }

    /**
     * @param string $coin
     * @param string $walletId
     * @return array|null
     */
    public function getWallet(string $coin, string $walletId): ?array
    {
        $endpoint = "$coin/wallet/{$walletId}";
        $response = self::httpGet($endpoint);

        return $response->json();
    }

    /**
     * @param string $coin
     * @param string $walletId
     * @param ?string $label
     * @return array|null
     */
    public function generaAddressOnWallet(string $coin, string $walletId, string $label = null): ?array
    {
        $endpoint = "$coin/wallet/$walletId/address";
        $response = $this->httpPostExpress($endpoint, ['label' => $label]);

        return $response->json();
    }

    /**
     * @param string $coin
     * @param string $walletId
     * @param int $numConfirmations
     * @param string|null $callbackUrl
     * @return array|null
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
}
