<?php

namespace SmstoOtp;


class Otp
{
    public static function generateNumericOTP($recipient, $cache = null, $noOfDigits = 4)
    {
        $generator = time();
        $result = "";
        $cache = $cache ?? Cache::getInstance();
        $recipient = str_replace('+', '', $recipient);
        $value = $cache->get($recipient);
        if ($value)
        {
            throw new \Exception('OTP Code already sent');
        }
        for ($i = 1; $i <= $noOfDigits; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }
        Cache::getInstance()->set($recipient, $result, ['EX' => 4 * 60]);
        return $result;
    }

    public static function verifyOtp($recipient, $code, $cache = null)
    {
        $cache = $cache ?? Cache::getInstance();
        $recipient = str_replace('+', '', $recipient);
        $value = $cache->get($recipient);
        if(!$value)
        {
            return false;
        }
        if($value && $value != $code)
        {
            return false;
        }
        $cache->del($recipient);
        return true;
    }
}