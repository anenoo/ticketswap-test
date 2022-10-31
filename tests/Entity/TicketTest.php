<?php

namespace TicketSwap\Assessment\tests\Entity;

use PHPUnit\Framework\TestCase;
use TicketSwap\Assessment\Entity\Buyer;
use TicketSwap\Assessment\Entity\Decorators\Barcode;
use TicketSwap\Assessment\Entity\Decorators\TicketId;
use TicketSwap\Assessment\Entity\Ticket;
use TicketSwap\Assessment\tests\MockData\Tickets\TicketExample;
use TicketSwap\Assessment\tests\MockData\Tickets\TicketWithThreeBarcodesExample;
use TicketSwap\Assessment\tests\MockData\Tickets\TicketWithTwoBarcodesExample;

class TicketTest extends TestCase
{
    /**
     * Business Rule: It should be possible to create a Ticket with one barcode
     * @covers \TicketSwap\Assessment\Entity\Ticket::__construct
     * @group ticket
     * @test
     */
    public function itShouldBePossibleCreateATicketInitial()
    {
        $createTicket = new Ticket(
            new TicketId(id: '6293BB44-2F5F-4E2A-ACA8-8CDF01AF401B'),
            [new Barcode(type: 'EAN-13', value: '38974312923')]
        );

        $this->assertCount(1, $createTicket->getBarcodes());
    }

    /**
     * Business Rule: It should be possible to create a Ticket with one barcode
     * @covers \TicketSwap\Assessment\Entity\Ticket::setId
     * @covers \TicketSwap\Assessment\Entity\Ticket::getId
     * @group ticket
     * @test
     */
    public function itShouldBePossibleSetIdForTicket()
    {
        $createTicket = (new TicketExample())->getTicket();
        $createTicket->setId(new TicketId('6293BB44-2F5F-4E2A-WERT-8CDF01AF401B'));

        $this->assertEquals('6293BB44-2F5F-4E2A-WERT-8CDF01AF401B', $createTicket->getId()->getId());
    }

    /**
     * Business Rule: It should be possible to create a Ticket with one barcode
     * @covers \TicketSwap\Assessment\Entity\Ticket::setBuyer
     * @covers \TicketSwap\Assessment\Entity\Ticket::getBuyer
     * @group ticket
     * @test
     */
    public function itShouldBePossibleCreateSetBuyerForTicket()
    {
        $createTicket = (new TicketExample())->getTicket();
        $createTicket->setBuyer(new Buyer('Mariya'));

        $this->assertEquals('Mariya', $createTicket->getBuyer()->getName());
    }

    /**
     * Business Rule: It should be possible to create a Ticket with one barcode
     * @covers \TicketSwap\Assessment\Entity\Ticket::isBought
     * @group ticket
     * @test
     */
    public function itShouldBePossibleCheckTicketIsBought()
    {
        $createTicket = (new TicketExample())->getTicket();
        $createTicket->setBuyer(new Buyer('Mariya'));

        $this->assertTrue($createTicket->isBought());
    }

    /**
     * Business Rule: It should be possible to create a Ticket with one barcode
     * @covers \TicketSwap\Assessment\Entity\Ticket::getBarcodes
     * @group ticket
     * @test
     */
    public function itShouldBePossibleCreateATicketWithOneBarcode()
    {
        $createTicket = (new TicketExample())->getTicket();

        $this->assertCount(1, $createTicket->getBarcodes());
    }

    /**
     * Business Rule: It should be possible to create a Ticket with Multiple barcode
     * @covers \TicketSwap\Assessment\Entity\Ticket::getBarcodes
     * @group ticket
     * @test
     */
    public function itShouldBePossibleCreateATicketWithMultipleBarcode()
    {
        $createTicket = (new TicketWithThreeBarcodesExample())->getTicket();

        $this->assertCount(3, $createTicket->getBarcodes());
    }

    /**
     * Business Rule: It should be possible to create a Ticket with Multiple barcode by adding new barcode
     * @covers \TicketSwap\Assessment\Entity\Ticket::addToBarcodes
     * @group ticket
     * @test
     */
    public function itShouldBePossibleToAddABarcodeForTicket()
    {
        $createTicket = (new TicketExample())->getTicket();

        $createTicket->addToBarcodes(new Barcode('EAN-67', '45678903456'));

        $this->assertCount(2, $createTicket->getBarcodes());
    }

    /**
     * Business Rule: It should be possible to create a Ticket with Multiple barcode by adding new barcode
     * @covers \TicketSwap\Assessment\Entity\Ticket::setBarcodes
     * @group ticket
     * @test
     */
    public function itShouldBePossibleToAddMultipleBarcodesForTicket()
    {
        $createTicket = (new TicketExample())->getTicket();

        $createTicket->setBarcodes([
            new Barcode('EAN-67', '45678903456'),
            new Barcode('EAN-13', '23456789567')
        ]);

        $this->assertCount(2, $createTicket->getBarcodes());
    }


    /**
     * Business Rule: It should be possible to remove from barcodes of a Ticket
     * @covers \TicketSwap\Assessment\Entity\Ticket::removeFromBarcodes
     * @group ticket
     * @test
     */
    public function itShouldBePossibleRemoveFromBarcodesForTicket()
    {
        $createTicket = (new TicketWithTwoBarcodesExample())->getTicket();

        $createTicket->removeFromBarcodes(new Barcode('EAN-89', '23456789456'));

        $this->assertCount(1, $createTicket->getBarcodes());
    }
}
