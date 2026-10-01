<?php

use PHPUnit\Framework\TestCase;
use Elx\PennylanePhp\Product;

final class ProductTest extends TestCase
{
    public function testProductGet()
    {
        $products = Product::get();
        $this->assertNotNull($products);
        $this->assertIsArray($products);
    }
}