
[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/support-ukraine.svg?t=1" />](https://supportukrainenow.org)

[comment]: <> (# :package_description)

[comment]: <> ([![Latest Version on Packagist]&#40;https://img.shields.io/packagist/v/:vendor_slug/:package_slug.svg?style=flat-square&#41;]&#40;https://packagist.org/packages/:vendor_slug/:package_slug&#41;)

[comment]: <> ([![GitHub Tests Action Status]&#40;https://img.shields.io/github/workflow/status/:vendor_slug/:package_slug/run-tests?label=tests&#41;]&#40;https://github.com/:vendor_slug/:package_slug/actions?query=workflow%3Arun-tests+branch%3Amain&#41;)

[comment]: <> ([![GitHub Code Style Action Status]&#40;https://img.shields.io/github/workflow/status/:vendor_slug/:package_slug/Check%20&%20fix%20styling?label=code%20style&#41;]&#40;https://github.com/:vendor_slug/:package_slug/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain&#41;)

[comment]: <> ([![Total Downloads]&#40;https://img.shields.io/packagist/dt/:vendor_slug/:package_slug.svg?style=flat-square&#41;]&#40;https://packagist.org/packages/:vendor_slug/:package_slug&#41;)

[comment]: <> (## Installation)

You can install the package via composer:

```bash
composer require khomerikik/laravel-bitgo-wallet
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Khomeriki\BitgoWallet\BitgoServiceProvider"
```

This is the contents of the published config file:

```php
return [
    'use_mocks' => env('BITGO_USE_MOCKS', true),//for tests

    'testnet' => env('BITGO_TESTNET', true),

    'api_key' => env('BITGO_API_KEY'),
    'v2_api_prefix' => 'api/v2/',
    'testnet_api_url'=>'https://app.bitgo-test.com',
    'mainnet_api_url'=>'https://app.bitgo.com',
    'express_api_url' => env('BITGO_EXPRESS_API_URL'),

    'default_coin' => env('BITGO_DEFAULT_COIN', 'tbtc'),
    'webhook_callback_url' => env('BITGO_WEBHOOK_CALLBACK'),
];
```

## Usage

### Generate a wallet with webhooks
```php
use Khomeriki\BitgoWallet\Facades\Wallet;
$wallet = Wallet::init('tbtc')
                ->generate(label: 'wallet label', passphrase: 'password')
                ->addWebhook(numConfirmations: 0)
                ->addWebhook(numConfirmations: 1);
return $wallet;
```

### Generate address on  an existing wallet
```php
use Khomeriki\BitgoWallet\Facades\Wallet;
$wallet = Wallet::init('tbtc', 'your-wallet-id')
                ->generateAddress(label: 'address label');
return $wallet->address;
```

### Check maximum spendable amount on a wallet
```php
use Khomeriki\BitgoWallet\Facades\Wallet;
$wallet = Wallet::init(coin: 'tbtc', id: 'your-wallet-id')
                ->getMaximumSpendable();
```

### Get all the transactions on wallet
```php
use Khomeriki\BitgoWallet\Facades\Wallet;
$wallet = Wallet::init(coin: 'tbtc', id: 'your-wallet-id')
                ->getTransfers();
```

### Get transfer by transfer id
```php
use Khomeriki\BitgoWallet\Facades\Wallet;
$wallet = Wallet::init(coin: 'tbtc', id: 'your-wallet-id')
                ->getTransfer(transferId: 'transferId');
```

### Send transaction from a wallet

```php
use Khomeriki\BitgoWallet\Data\TransferRecipients;
use Khomeriki\BitgoWallet\Data\TransferRecipient;
use Khomeriki\BitgoWallet\Facades\Wallet;
use Khomeriki\BitgoWallet\Data\Transfer;

//you can add as many recipients as you need :)
$transferRecipients = new TransferRecipients(
    new TransferRecipient(amount: 4934, address: 'address'),
    new TransferRecipient(amount: 4334, address: 'address1'),
);
$transfer = new Transfer(
    walletPassphrase: 'test',
    transferRecipients: $transferRecipients,
);
return Wallet::init('tbtc', 'wallet-id')->sendTransfer($transfer);
```

## Testing

```bash
composer test
```

## Changelog

[comment]: <> (Please see [CHANGELOG]&#40;CHANGELOG.md&#41; for more information on what has changed recently.)

[comment]: <> (## Contributing)

[comment]: <> (Please see [CONTRIBUTING]&#40;https://github.com/spatie/.github/blob/main/CONTRIBUTING.md&#41; for details.)

[comment]: <> (## Security Vulnerabilities)

[comment]: <> (Please review [our security policy]&#40;../../security/policy&#41; on how to report security vulnerabilities.)

## Credits

- [KhomerikiK](https://github.com/KhomerikiK)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
