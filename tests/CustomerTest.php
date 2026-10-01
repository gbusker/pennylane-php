<?php

use PHPUnit\Framework\TestCase;
use Elx\PennylanePhp\Customer;

final class CustomerTest extends TestCase
{
    public function testCustomerGetNotExists()
    {
        $customer = Customer::getByEmail('john@doesnotexist.com');
        $this->assertNull($customer);
    }

    public function testCustomerGetExists()
    {
        $customer = Customer::getByEmail('john@test.org');
        $this->assertNotNull($customer);
    }

    public function testCustomerCreate()
    {
        $customerData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'emails' => ['johndoe@test.org'],
            'billing_address' => [
                'address' => '123 Main St',
                'city' => 'Anytown',
                'postal_code' => '12345',
                'country_alpha2' => 'US'
            ]
        ];
        $response = Customer::create($customerData);
        $this->assertNotNull($response);
    }

    public function testCustomerCreateInvalidData()
    {
        $this->expectException(\Elx\PennylanePhp\ClientException::class);
        $customerData = [
            'first_name' => 'John',
            'last_name' => 'Doe'
        ];
        Customer::create($customerData);
    }

    public function testCustomerCreateDuplicateEmail()
    {
        $this->expectException(\InvalidArgumentException::class);
        $customerData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'emails' => ['john@test.org'],
            'billing_address' => [
                'address' => '123 Main St',
                'city' => 'Anytown',
                'postal_code' => '12345',
                'country_alpha2' => 'US'
            ]
        ];
        Customer::create($customerData);
    }
}
