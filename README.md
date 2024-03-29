
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


## Usage


### Generate a wallet with webhooks

```php

use Khomeriki\BitgoWallet\Facades\Wallet;

$wallet = Wallet::init(coin: 'tbtc')

                ->generate(label: 'wallet label', passphrase: 'password')

                ->addWebhook(numConfirmations: 0)

                ->addWebhook(numConfirmations: 1);

                
return $wallet;

```

### Add webhook on a wallet with custom callback url

```php

use Khomeriki\BitgoWallet\Facades\Wallet;

$wallet = Wallet::init(coin: 'tbtc', id: 'wallet-id')

                ->addWebhook(

                    numConfirmations: 3, 

                    callbackUrl: 'https://your-domain.com/api/callback'

                );

                
return $wallet;

```


### Generate address on  an existing wallet

```php

use Khomeriki\BitgoWallet\Facades\Wallet;


$wallet = Wallet::init(coin: 'tbtc', id: 'your-wallet-id')

                ->generateAddress(label: 'address label');

                
return $wallet->address;

```


### Check maximum spendable amount on a wallet

```php

use Khomeriki\BitgoWallet\Facades\Wallet;


$maxSpendable = Wallet::init(coin: 'tbtc', id: 'your-wallet-id')

                ->getMaximumSpendable();

                
return $maxSpendable;

```


### Get all the transactions on wallet

```php

use Khomeriki\BitgoWallet\Facades\Wallet;


$transfers = Wallet::init(coin: 'tbtc', id: 'your-wallet-id')

                ->getTransfers();

                
return $transfers;

```


### Get transfer by transfer id

```php

use Khomeriki\BitgoWallet\Facades\Wallet;


$transfer = Wallet::init(coin: 'tbtc', id: 'your-wallet-id')

                ->getTransfer(transferId: 'transferId');

                
return $transfer;

```


### Send transfer from a wallet


```php

use Khomeriki\BitgoWallet\Data\Requests\TransferData;use Khomeriki\BitgoWallet\Data\Requests\TransferRecipientData;use Khomeriki\BitgoWallet\Facades\Wallet;


//you can add as many recipients as you need :)

$recipient = TransferRecipientData::fromArray([

    'amount' => 4934, 

    'address' => 'address'

]);

$recipientOne = TransferRecipientData::fromArray([

    'amount' => 4934, 

    'address' => 'address'

]);


$transferData = TransferData::fromArray([

    'walletPassphrase' => 'test',

    'recipients' => [$recipient, $recipientOne]

]);


$result = Wallet::init('tbtc', 'wallet-id')->sendTransfer($transferData);


return $result;

```


## Testing


```bash

composer test

```


## Credits


- [KhomerikiK](https://github.com/KhomerikiK)


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
