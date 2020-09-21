<?php

require __DIR__ . '/vendor/autoload.php';

$apiKey = '<<Api Key Obtained from SMS.to>>';


$response = \Smsto\Otp::verifyOtp('Recipient number in E+164 format', 7884);
// 4569
var_dump($response);