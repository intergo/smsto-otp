<?php

namespace App;


class Otp
{
    public static function generateNumericOTP($recipient, $n = 4) {

        $generator = "1357902468";
        $result = "";
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }
        $recipient = str_replace('+', '', $recipient);
        $value = Cache::getInstance()->get($recipient);
        if ($value)
        {
            throw new \Exception('OTP Code already sent');
        }
        Cache::getInstance()->set($recipient, $result, ['EX' => 4 * 60]);
        return $result;
    }

    public static function verifyOtp($recipient, $code)
    {
        $recipient = str_replace('+', '', $recipient);
        $value = Cache::getInstance()->get($recipient);
        if(!$value)
        {
            return false;
        }
        if($value && $value != $code)
        {
            return false;
        }
        return true;
    }
}