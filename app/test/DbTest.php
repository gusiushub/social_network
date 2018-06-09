<?php

namespace app\test;
use app\core\ConnectDb;
use PHPU;
class SingletonTest extends TestCase
{
    public function testUniqueness()
    {
        $firstCall = ConnectDb::getInstance();
        $secondCall = ConnectDb::getInstance();
        $this->assertInstanceOf(Singleton::class, $firstCall);
        $this->assertSame($firstCall, $secondCall);
    }
}