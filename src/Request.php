<?php

namespace SmstoOtp;


class Request
{
    private $apiKey;

    private $url = 'https://api.sms.to/sms/send';

    private $cache;

    public function __construct($apiKey, $cache = null)
    {
        $this->apiKey = $apiKey;
        $this->cache = $cache;
    }

    /**
     * @throws \Exception
     */
    public function sendOtp($recipient, $senderId = 'smsto', $message = 'Your code is @code', $noOfDigits = 4)
    {
        $ch = curl_init($this->url);
        $code = Otp::generateNumericOTP($recipient, $this->cache, $noOfDigits);
        $message = str_replace('@code', $code, $message);
        $payload = [
            'to' => $recipient,
            'message' => $message,
            'sender_id' => $senderId,
        ];
        $data = json_encode($payload);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer ' . $this->apiKey]);
        $output = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($output, true);
        $json['code'] = $code;
        return $json;
    }
}