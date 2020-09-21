<?php

namespace SmstoOtp;

class Cache
{
    static $client;

    public static function getInstance($host = 'localhost', $port = '6379')
    {
        if(static::$client)
        {
            return static::$client;
        }
        $client = new \Redis();
        $client->connect($host, $port);
        return $client;
    }
}