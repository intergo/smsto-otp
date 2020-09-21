<?php

require __DIR__ . '/vendor/autoload.php';

$apiKey = '<<Api Key Obtained from SMS.to>>';

$request = new \Smsto\Request($apiKey);
$response = $request->sendOtp('Recipient number in E+164 format');
// 4569
var_dump($response);