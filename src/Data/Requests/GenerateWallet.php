<?php

namespace Khomeriki\BitgoWallet\Data\Requests;

use Khomeriki\BitgoWallet\Data\Data;

class GenerateWallet extends Data
{
    /**
     * WalletLabel
     *
     * @var string
     */
    public string $label;

    /***
     * Passphrase to be used to encrypt the user key on the wallet
     * @var string
     */
    public string $passphrase;

    /**
     * User provided public key
     *
     * @var string
     */
    public string $userKey;

    /**
     * public part of a key pair
     *
     * @var string
     */
    public string $backupXpub;

    /**
     * Optional key recovery service to provide and store the backup key
     *
     * @var string
     */
    public string $backupXpubProvider;

    /**
     *  (Id) ^[0-9a-f]{32}$
     *
     * @var string
     */
    public string $enterprise;

    /**
     * Flag for disabling wallet transaction notifications
     *
     * @var bool
     */
    public bool $disableTransactionNotifications;

    /**
     * The passphrase used for decrypting the encrypted user private key during wallet recovery
     *
     * @var string
     */
    public string $passcodeEncryptionCode;

    /**
     * Seed used to derive an extended user key for a cold wallet
     *
     * @var string
     */
    public string $coldDerivationSeed;

    /**
     * Gas price to use when deploying an Ethereum wallet
     *
     * @var int
     */
    public int $gasPrice;

    /**
     * Flag for preventing KRS from sending email after creating backup key
     *
     * @var bool
     */
    public bool $disableKRSEmail;

    /**
     * (ETH only) Specify the wallet creation contract version used when creating a wallet contract.
     * Use 0 for the old wallet creation,
     * 1 for the new wallet creation, where it is only deployed upon receiving funds.
     *
     * @var int
     */
    public int $walletVersion = 1;
}
