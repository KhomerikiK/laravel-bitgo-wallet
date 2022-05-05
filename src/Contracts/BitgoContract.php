<?php

namespace Khomeriki\BitgoWallet\Contracts;

use Illuminate\Http\Client\Response;

interface BitgoContract
{
    /**
     * @return Response
     */
    public function me(): Response;

    /**
     * @return Response
     */
    public function pingExpress(): Response;

    /**
     * @return Response
     */
    public function ping(): Response;
}
