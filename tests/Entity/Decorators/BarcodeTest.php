<?php

namespace TicketSwap\Assessment\tests\Entity\Decorators;

use PHPUnit\Framework\TestCase;
use TicketSwap\Assessment\Entity\Decorators\Barcode;

class BarcodeTest extends TestCase
{
    /**
     * @covers \TicketSwap\Assessment\Entity\Decorators\Barcode::__construct
     * @group barcode
     * @test
     */
    public function itShouldBePossibleToCreateBarcode()
    {
        $barcode = new Barcode(type: 'EAN-13', value: '38974312923');
        $this->assertEquals('EAN-13:38974312923', (string)$barcode);
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Decorators\Barcode::setType
     * @group barcode
     * @test
     */
    public function itShouldBePossibleChangeTheType()
    {
        $barcode = new Barcode(type: 'EAN-13', value: '38974312923');
        $barcode->setType('EAN-78');
        $this->assertEquals('EAN-78:38974312923', (string)$barcode);
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Decorators\Barcode::setValue
     * @group barcode
     * @test
     */
    public function itShouldBePossibleChangeTheValue()
    {
        $barcode = new Barcode(type: 'EAN-13', value: '38974312923');
        $barcode->setValue('1234567890');
        $this->assertEquals('EAN-13:1234567890', (string)$barcode);
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Decorators\Barcode::getValue
     * @group barcode
     * @test
     */
    public function itShouldBePossibleGetTheValue()
    {
        $barcode = new Barcode(type: 'EAN-13', value: '38974312923');
        $this->assertEquals('38974312923', $barcode->getValue());
    }


    /**
     * @covers \TicketSwap\Assessment\Entity\Decorators\Barcode::getType
     * @group barcode
     * @test
     */
    public function itShouldBePossibleGetTheType()
    {
        $barcode = new Barcode(type: 'EAN-13', value: '38974312923');
        $this->assertEquals('EAN-13', $barcode->getType());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Decorators\Barcode::__toString
     * @group barcode
     * @test
     */
    public function itShouldBePossibleToGetTheStringOfBarcode()
    {
        $barcode = new Barcode(type: 'EAN-13', value: '38974312923');
        $this->assertEquals('EAN-13:38974312923', $barcode->__toString());
    }
}
