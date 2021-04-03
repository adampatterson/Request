<?php

use Numeral\Numeral;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{

    public function testNumberFormatWhole()
    {
        $this->assertEquals(1234, 1234);
    }
}