<?php

namespace Khomeriki\BitgoWallet;

use Illuminate\Support\Facades\Http;

class Bitgo
{
    /**
     * @return array|null
     */
    public function me(): ?array
    {
        return $this->httpGet('user/me');
    }

    /**
     * @param string $endpoint
     * @return array|null
     */
    protected function httpGet(string $endpoint): ?array
    {
        /** @phpstan-ignore-next-line */
        return Http::bitgo()->get($endpoint)->json();
    }

    /**
     * @param string $endpoint
     * @param array $data
     * @return array|null
     */
    protected function httPost(string $endpoint, array $data): ?array
    {
        /** @phpstan-ignore-next-line */
        return Http::bitgo()->get($endpoint, $data)->json();
    }

    /**
     * @param string $endpoint
     * @param array $data
     * @return array|null
     */
    protected function httpPostExpress(string $endpoint, array $data): ?array
    {
        /** @phpstan-ignore-next-line */
        return Http::bitgoExpress()->post($endpoint, $data)->json();
    }
}
