<?php

namespace TicketSwap\Assessment\tests\Entity;

use PHPUnit\Framework\TestCase;
use TicketSwap\Assessment\Entity\Decorators\Barcode;
use TicketSwap\Assessment\tests\MockData\Tickets\TicketExample;
use TicketSwap\Assessment\tests\MockData\Tickets\TicketWithThreeBarcodesExample;
use TicketSwap\Assessment\tests\MockData\Tickets\TicketWithTwoBarcodesExample;

class TicketTest extends TestCase
{


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