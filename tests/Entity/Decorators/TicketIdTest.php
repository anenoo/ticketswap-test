<?php

namespace TicketSwap\Assessment\tests\Entity\Decorators;

use PHPUnit\Framework\TestCase;
use TicketSwap\Assessment\Entity\Decorators\TicketId;

class TicketIdTest extends TestCase
{
    /**
     * @covers \TicketSwap\Assessment\Entity\Decorators\TicketId::__construct
     * @group ticketId
     * @test
     */
    public function itShouldBePossibleToCreateBarcode()
    {
        $ticketId = new TicketId(id: '234567890');
        $this->assertEquals('234567890', (string)$ticketId);
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Decorators\TicketId::__toString
     * @group ticketId
     * @test
     */
    public function itShouldBePossibleToGetStringValueForTicketId()
    {
        $ticketId = new TicketId(id: '234567890');
        $this->assertEquals('234567890', $ticketId->__toString());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Decorators\TicketId::setId
     * @group ticketId
     * @test
     */
    public function itShouldBePossibleToSetNewIdForTicket()
    {
        $ticketId = new TicketId(id: '234567890');
        $ticketId->setId('678902345678');
        $this->assertEquals('678902345678', $ticketId->getId());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Decorators\TicketId::getId
     * @group ticketId
     * @test
     */
    public function itShouldBePossibleToGetIdForTicket()
    {
        $ticketId = new TicketId(id: '234567890');
        $this->assertEquals('234567890', $ticketId->getId());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Decorators\TicketId::equals
     * @group ticketId
     * @test
     */
    public function itShouldBePossibleToCheckEqualId()
    {
        $ticketId = new TicketId(id: '234567890');
        $this->assertTrue($ticketId->equals(new TicketId('234567890')));
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Decorators\TicketId::equals
     * @group ticketId
     * @test
     */
    public function itShouldBePossibleToCheckNotEqualId()
    {
        $ticketId = new TicketId(id: '234567890');
        $this->assertFalse($ticketId->equals(new TicketId('23456789345')));
    }
}
