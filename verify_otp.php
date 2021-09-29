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