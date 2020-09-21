## Minimum Requirement
- Redis extension for php

## Install the package
> composer require itsursujit/smsto-otp:dev-master

Or Add to composer.json as
> "itsursujit/smsto-otp": "dev-master"

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
$cache = Cache::getInstance('localhost', 6379);
$request = new Request($apiKey);
$response = $request->sendOtp($recipient, $senderId, $cache);
// 4569
var_dump($response);
```

Providing `$cache` is optional

```php
<?php

use SmstoOtp\Cache;
use SmstoOtp\Otp;

require __DIR__ . '/vendor/autoload.php';

$apiKey = '<<Api Key Obtained from SMS.to>>';

$recipient = 'Recipient number in E+164 format';
$code = 3487;

$cache = Cache::getInstance('localhost', 6379);
$response = Otp::verifyOtp($recipient, $code, $cache);
// $response is either
// true for verifying the number or
// false for expired or invalid attempt
var_dump($response);
```