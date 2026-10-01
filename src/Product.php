<?php

namespace Elx\PennylanePhp;

use Elx\PennylanePhp\Client;


class Product
{
    /**
     * Get all products.
     * XXX Note this seems to have the concept of pagination, but we ignore for now.
     *
     * @return array
     */
    public static function get() : array
    {
        $client = new Client();
        return $client->get('products')['items'];
    }
}