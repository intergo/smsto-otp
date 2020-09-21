<?php

namespace Smsto;

class Cache
{
    public static function getInstance($host = 'localhost', $port = '6379')
    {
        $client = new \Redis();
        $client->connect($host, $port);
        return $client;
    }
}