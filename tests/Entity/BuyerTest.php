<?php

namespace TicketSwap\Assessment\tests\Entity;

use PHPUnit\Framework\TestCase;
use TicketSwap\Assessment\Entity\Buyer;

class BuyerTest extends TestCase
{
    /**
     * @covers \TicketSwap\Assessment\Entity\Buyer::__construct
     * @group buyer
     * @test
     */
    public function itShouldBePossibleToCreateBuyerByConstruct()
    {
        $buyer = new Buyer(
            name: 'Sara'
        );
        $this->assertEquals('Sara', $buyer->getName());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Buyer::setName
     * @group buyer
     * @test
     */
    public function itShouldBePossibleToSetNewNameForBuyer()
    {
        $buyer = new Buyer(
            name: 'Sara'
        );
        $buyer->setName('Tom');
        $this->assertEquals('Tom', $buyer->getName());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Buyer::getName
     * @group buyer
     * @test
     */
    public function itShouldBePossibleToGetNameForBuyer()
    {
        $buyer = new Buyer(
            name: 'Sara'
        );
        $this->assertEquals('Sara', $buyer->getName());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Buyer::__toString
     * @group buyer
     * @test
     */
    public function itShouldBePossibleToGetStringValueForBuyer()
    {
        $buyer = new Buyer(
            name: 'Sara'
        );
        $this->assertEquals('Sara', $buyer->__toString());
    }
}
