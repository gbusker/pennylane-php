<?php

namespace Elx\PennylanePhp;
use Elx\PennylanePhp\Client;

class Customer
{
    public static function getByEmail(string $email)
    {
        $client = new Client();
        $customers = $client->get('customers')['items'] ?? [];
        foreach ($customers as $customer) {
            if (in_array($email, $customer['emails'])) {
                return $customer;
            }
        }
        return null;
    }

    public static function create(array $customerData)
    {
        if ( $customerData['emails'] &&  SELF::getByEmail($customerData['emails'][0]) )
        {
            throw new \InvalidArgumentException('Customer with this email already exists');
        }
        $client = new Client();
        return $client->post("individual_customers", $customerData);
    }

    public static function delete(string $email)
    {
        $customer = self::getByEmail($email);
        if (!$customer) {
            throw new \InvalidArgumentException('Customer with this email does not exist');
        }
        $client = new Client();
        return $client->post("individual_customers/{$customer['id']}/delete", []);
    }
}