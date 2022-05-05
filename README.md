
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
php artisan vendor:publish --tag=":laravel-bitgo-wallet-config"
```

This is the contents of the published config file:

```php
return [
    'express_api_url' => env('BITGO_EXPRESS_API_URL'),
    'api_key' => env('BITGO_API_KEY'),
    'v2_api_prefix' => 'api/v2/',

    'testnet_api_url'=>'https://app.bitgo-test.com',
    'mainnet_api_url'=>'https://app.bitgo.com',

    'testnet' => env('BITGO_TESTNET', true),

    'default_coin' => env('BITGO_DEFAULT_COIN', 'tbtc'),
    'webhook_callback_url' => env('BITGO_WEBHOOK_CALLBACK'),
];
```

## Usage

```php
$wallet = Wallet::init('tbtc')
                ->generate('wallet label', 'password')
                ->generateAddress();

echo $wallet;
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

[comment]: <> (## Contributing)

[comment]: <> (Please see [CONTRIBUTING]&#40;https://github.com/spatie/.github/blob/main/CONTRIBUTING.md&#41; for details.)

[comment]: <> (## Security Vulnerabilities)

[comment]: <> (Please review [our security policy]&#40;../../security/policy&#41; on how to report security vulnerabilities.)

## Credits

- [:KhomerikiK](https://github.com/KhomerikiK)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
