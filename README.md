
[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/support-ukraine.svg?t=1" />](https://supportukrainenow.org)

[comment]: <> (# :package_description)

[comment]: <> ([![Latest Version on Packagist]&#40;https://img.shields.io/packagist/v/:vendor_slug/:package_slug.svg?style=flat-square&#41;]&#40;https://packagist.org/packages/:vendor_slug/:package_slug&#41;)

[comment]: <> ([![GitHub Tests Action Status]&#40;https://img.shields.io/github/workflow/status/:vendor_slug/:package_slug/run-tests?label=tests&#41;]&#40;https://github.com/:vendor_slug/:package_slug/actions?query=workflow%3Arun-tests+branch%3Amain&#41;)

[comment]: <> ([![GitHub Code Style Action Status]&#40;https://img.shields.io/github/workflow/status/:vendor_slug/:package_slug/Check%20&%20fix%20styling?label=code%20style&#41;]&#40;https://github.com/:vendor_slug/:package_slug/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain&#41;)

[comment]: <> ([![Total Downloads]&#40;https://img.shields.io/packagist/dt/:vendor_slug/:package_slug.svg?style=flat-square&#41;]&#40;https://packagist.org/packages/:vendor_slug/:package_slug&#41;)

[comment]: <> (## Installation)

Coming soon...

[//]: # (You can install the package via composer:)

[//]: # ()
[//]: # (```bash)

[//]: # (composer require khomerikik/laravel-bitgo-wallet)

[//]: # (```)

[//]: # ()
[//]: # (You can publish the config file with:)

[//]: # ()
[//]: # (```bash)

[//]: # (php artisan vendor:publish --provider="Khomeriki\BitgoWallet\BitgoServiceProvider")

[//]: # (```)

[//]: # ()
[//]: # (This is the contents of the published config file:)

[//]: # ()
[//]: # (```php)

[//]: # (return [)

[//]: # (    'use_mocks' => env&#40;'BITGO_USE_MOCKS', true&#41;,//for tests)

[//]: # ()
[//]: # (    'testnet' => env&#40;'BITGO_TESTNET', true&#41;,)

[//]: # ()
[//]: # (    'api_key' => env&#40;'BITGO_API_KEY'&#41;,)

[//]: # (    'v2_api_prefix' => 'api/v2/',)

[//]: # (    'testnet_api_url'=>'https://app.bitgo-test.com',)

[//]: # (    'mainnet_api_url'=>'https://app.bitgo.com',)

[//]: # (    'express_api_url' => env&#40;'BITGO_EXPRESS_API_URL'&#41;,)

[//]: # ()
[//]: # (    'default_coin' => env&#40;'BITGO_DEFAULT_COIN', 'tbtc'&#41;,)

[//]: # (    'webhook_callback_url' => env&#40;'BITGO_WEBHOOK_CALLBACK'&#41;,)

[//]: # (];)

[//]: # (```)

[//]: # ()
[//]: # (## Usage)

[//]: # ()
[//]: # (### Generate a wallet with webhooks)

[//]: # (```php)

[//]: # (use Khomeriki\BitgoWallet\Facades\Wallet;)

[//]: # ($wallet = Wallet::init&#40;coin: 'tbtc'&#41;)

[//]: # (                ->generate&#40;label: 'wallet label', passphrase: 'password'&#41;)

[//]: # (                ->addWebhook&#40;numConfirmations: 0&#41;)

[//]: # (                ->addWebhook&#40;numConfirmations: 1&#41;;)

[//]: # (                )
[//]: # (return $wallet;)

[//]: # (```)

[//]: # (### Add webhook on a wallet with custom callback url)

[//]: # (```php)

[//]: # (use Khomeriki\BitgoWallet\Facades\Wallet;)

[//]: # ($wallet = Wallet::init&#40;coin: 'tbtc', id: 'wallet-id'&#41;)

[//]: # (                ->addWebhook&#40;)

[//]: # (                    numConfirmations: 3, )

[//]: # (                    callbackUrl: 'https://your-domain.com/api/callback')

[//]: # (                &#41;;)

[//]: # (                )
[//]: # (return $wallet;)

[//]: # (```)

[//]: # ()
[//]: # (### Generate address on  an existing wallet)

[//]: # (```php)

[//]: # (use Khomeriki\BitgoWallet\Facades\Wallet;)

[//]: # ()
[//]: # ($wallet = Wallet::init&#40;coin: 'tbtc', id: 'your-wallet-id'&#41;)

[//]: # (                ->generateAddress&#40;label: 'address label'&#41;;)

[//]: # (                )
[//]: # (return $wallet->address;)

[//]: # (```)

[//]: # ()
[//]: # (### Check maximum spendable amount on a wallet)

[//]: # (```php)

[//]: # (use Khomeriki\BitgoWallet\Facades\Wallet;)

[//]: # ()
[//]: # ($maxSpendable = Wallet::init&#40;coin: 'tbtc', id: 'your-wallet-id'&#41;)

[//]: # (                ->getMaximumSpendable&#40;&#41;;)

[//]: # (                )
[//]: # (return $maxSpendable;)

[//]: # (```)

[//]: # ()
[//]: # (### Get all the transactions on wallet)

[//]: # (```php)

[//]: # (use Khomeriki\BitgoWallet\Facades\Wallet;)

[//]: # ()
[//]: # ($transfers = Wallet::init&#40;coin: 'tbtc', id: 'your-wallet-id'&#41;)

[//]: # (                ->getTransfers&#40;&#41;;)

[//]: # (                )
[//]: # (return $transfers;)

[//]: # (```)

[//]: # ()
[//]: # (### Get transfer by transfer id)

[//]: # (```php)

[//]: # (use Khomeriki\BitgoWallet\Facades\Wallet;)

[//]: # ()
[//]: # ($transfer = Wallet::init&#40;coin: 'tbtc', id: 'your-wallet-id'&#41;)

[//]: # (                ->getTransfer&#40;transferId: 'transferId'&#41;;)

[//]: # (                )
[//]: # (return $transfer;)

[//]: # (```)

[//]: # ()
[//]: # (### Send transfer from a wallet)

[//]: # ()
[//]: # (```php)

[//]: # (use Khomeriki\BitgoWallet\Data\Requests\TransferData;use Khomeriki\BitgoWallet\Data\Requests\TransferRecipientData;use Khomeriki\BitgoWallet\Facades\Wallet;)

[//]: # ()
[//]: # (//you can add as many recipients as you need :&#41;)

[//]: # ($recipient = TransferRecipientData::fromArray&#40;[)

[//]: # (    'amount' => 4934, )

[//]: # (    'address' => 'address')

[//]: # (]&#41;;)

[//]: # ($recipientOne = TransferRecipientData::fromArray&#40;[)

[//]: # (    'amount' => 4934, )

[//]: # (    'address' => 'address')

[//]: # (]&#41;;)

[//]: # ()
[//]: # ($transferData = TransferData::fromArray&#40;[)

[//]: # (    'walletPassphrase' => 'test',)

[//]: # (    'recipients' => [$recipient, $recipientOne])

[//]: # (]&#41;;)

[//]: # ()
[//]: # ($result = Wallet::init&#40;'tbtc', 'wallet-id'&#41;->sendTransfer&#40;$transferData&#41;;)

[//]: # ()
[//]: # (return $result;)

[//]: # (```)

[//]: # ()
[//]: # (## Testing)

[//]: # ()
[//]: # (```bash)

[//]: # (composer test)

[//]: # (```)

[//]: # ()
[//]: # (## Changelog)

[//]: # ()
[//]: # ([comment]: <> &#40;Please see [CHANGELOG]&#40;CHANGELOG.md&#41; for more information on what has changed recently.&#41;)

[//]: # ()
[//]: # ([comment]: <> &#40;## Contributing&#41;)

[//]: # ()
[//]: # ([comment]: <> &#40;Please see [CONTRIBUTING]&#40;https://github.com/spatie/.github/blob/main/CONTRIBUTING.md&#41; for details.&#41;)

[//]: # ()
[//]: # ([comment]: <> &#40;## Security Vulnerabilities&#41;)

[//]: # ()
[//]: # ([comment]: <> &#40;Please review [our security policy]&#40;../../security/policy&#41; on how to report security vulnerabilities.&#41;)

[//]: # ()
[//]: # (## Credits)

[//]: # ()
[//]: # (- [KhomerikiK]&#40;https://github.com/KhomerikiK&#41;)

[//]: # ()
[//]: # (## License)

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
