## Minimum Requirement
- Redis extension for php

Providing `$cache` is optional. By default will use redis with host: `localhost` and port: `6379`

## Install the package
> composer require intergo/smsto-otp:dev-master

Or Add to composer.json as
> "intergo/smsto-otp": "dev-master"

and run command
> composer update
## Examples

*Send OTP to a number*

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use SmstoOtp\Cache;
use SmstoOtp\Request;

$apiKey = '<<Api Key Obtained from SMS.to>>';
$senderId = 'smsto';
$recipient = 'Recipient number in E+164 format';
$message = 'Your OTP code is @code';
$cache = Cache::getInstance('localhost', 6379);
$request = new Request($apiKey, $cache);
$response = $request->sendOtp($recipient, $senderId, $message);
// 4569
var_dump($response);
```

```php
<?php

use SmstoOtp\Cache;
use SmstoOtp\Otp;

require __DIR__ . '/vendor/autoload.php';

$recipient = 'Recipient number in E+164 format';
$code = 1660;

$cache = Cache::getInstance('localhost', 6379);
$response = Otp::verifyOtp($recipient, $code, $cache);
// $response is either
// true for verifying the number or
// false for expired or invalid attempt
var_dump($response);
```