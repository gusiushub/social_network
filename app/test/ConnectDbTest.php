<?php
/**
 * Created by PhpStorm.
 * User: zolow
 * Date: 08.06.2018
 * Time: 22:47
 */

namespace app\test;

use app\core\ConnectDb;


class ConnectDbTest extends \PHPUnit_Framework_TestCase
{
    public function testUniqueness()
    {
        $firstCall = ConnectDb::getInstance();
        $secondCall = ConnectDb::getInstance();
        echo $firstCall;
        //$this->assertInstanceOf(ConnectDb::class, $firstCall);
        //$this->assertSame($firstCall, $secondCall);
    }
}
