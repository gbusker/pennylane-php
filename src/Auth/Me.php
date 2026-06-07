<?php


namespace Elx\PennylanePhp\Auth;
use Elx\PennylanePhp\Client;


class Me
{
    public static function get()
    {
        $client = new Client();
        return $client->get('/me');
    }
}