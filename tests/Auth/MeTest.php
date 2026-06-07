<?php

use PHPUnit\Framework\TestCase;
use Elx\PennylanePhp\Auth\Me;

final class MeTest extends TestCase
{
    public function testMe()
    {
        $user = Me::get();
        $this->assertNotNull($user);
    }
}