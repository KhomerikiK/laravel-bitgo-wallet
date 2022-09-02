<?php

namespace Khomeriki\BitgoWallet\Data\Responses;

use Khomeriki\BitgoWallet\Data\Data;

class PendingApproval extends Data
{
    /**
     * Time when the wallet becomes frozen
     *
     * @var string (Id) ^[0-9a-f]{32}$
     */
    public string $id;

    /**
     * A cryptocurrency or token ticker symbol.
     *
     * @var string
     */
    public string $coin;

    /**
     * @var string (Id) ^[0-9a-f]{32}$
     */
    public string $wallet;

    /**
     * @var string (Id) ^[0-9a-f]{32}$
     */
    public string $enterprise;

    /**
     * @var string (Id) ^[0-9a-f]{32}$
     */
    public string $creator;

    /**
     * @var string date-time
     */
    public string $createDate;

    /**
     * @var array
     */
    public array $info;

    /**
     * @var array
     */
    public array $state;

    /**
     * What kind of entity the Pending Approval is tied to
     *
     * @var string
     */
    public string $scope;

    /**
     * All the Users who should see this Pending Approval
     *
     * @var string
     */
    public string $userIds;

    /**
     * @var int
     */
    public int $approvalsRequired;

    /**
     * @var string
     */
    public string $walletLabel;
}
