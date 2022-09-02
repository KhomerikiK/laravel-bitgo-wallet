<?php

namespace Khomeriki\BitgoWallet\Data\Responses;

use Khomeriki\BitgoWallet\Data\Data;

class User extends Data
{
    /**
     * id of the user
     *
     * @var string
     */
    public string $user;

    /**
     * Array of permissions for the user
     *
     * @var array<string>
     */
    public array $permissions;
}
