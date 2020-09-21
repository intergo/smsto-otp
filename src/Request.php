<?php

namespace SmstoOtp;


class Request
{
    private $apiKey;

    private $url = 'https://api.sms.to/sms/send';

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function sendOtp($recipient, $senderId = 'smsto', $cache = null)
    {
        $ch = curl_init();
        $payload = http_build_query([
            'to' => $recipient,
            'message' => 'Your code is ' . Otp::generateNumericOTP($recipient, $cache),
            'api_key' => $this->apiKey,
            'sender_id' => $senderId,
        ]);
        $url = $this->url . '?' . $payload;
        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);

        return json_decode($output, true);
    }
}