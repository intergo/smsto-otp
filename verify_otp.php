<?php

require __DIR__ . '/vendor/autoload.php';

$apiKey = 'iy6y4elAx4B1MktI1Dckx0vuSNC2GZpD';


$response = \App\Otp::verifyOtp('Recipient number in E+164 format', 7884);
// 4569
var_dump($response);