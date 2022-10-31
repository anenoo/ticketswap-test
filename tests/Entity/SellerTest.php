<?php

namespace TicketSwap\Assessment\tests\Entity;

use PHPUnit\Framework\TestCase;
use TicketSwap\Assessment\Entity\Seller;

class SellerTest extends TestCase
{
    /**
     * @covers \TicketSwap\Assessment\Entity\Seller::__construct
     * @group seller
     * @test
     */
    public function itShouldBePossibleToCreateSellerByConstruct()
    {
        $seller = new Seller(
            name: 'Sara'
        );
        $this->assertEquals('Sara', $seller->getName());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Seller::setName
     * @group seller
     * @test
     */
    public function itShouldBePossibleToSetNewNameForSeller()
    {
        $seller = new Seller(
            name: 'Sara'
        );
        $seller->setName('Tom');
        $this->assertEquals('Tom', $seller->getName());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Seller::getName
     * @group seller
     * @test
     */
    public function itShouldBePossibleToGetNameForSeller()
    {
        $seller = new Seller(
            name: 'Sara'
        );
        $this->assertEquals('Sara', $seller->getName());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Seller::__toString
     * @group buyer
     * @test
     */
    public function itShouldBePossibleToGetStringValueForSeller()
    {
        $seller = new Seller(
            name: 'Sara'
        );
        $this->assertEquals('Sara', $seller->__toString());
    }
}
