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