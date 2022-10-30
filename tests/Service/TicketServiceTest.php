<?php

namespace TicketSwap\Assessment\tests\Service;

use PHPUnit\Framework\TestCase;
use TicketSwap\Assessment\Entity\Decorators\Barcode;
use TicketSwap\Assessment\Entity\Decorators\TicketId;
use TicketSwap\Assessment\Entity\Ticket;
use TicketSwap\Assessment\Service\TicketService;

class TicketServiceTest extends TestCase
{
    /**
     * @var TicketService
     */
    private TicketService $ticketService;

    /**
     * @before
     */
    public function setupInitial()
    {
        $this->ticketService = new TicketService();
    }

    /**
     * Business Rule: It should be possible to compare two tickets for finding has similar barcodes or not.
     * @covers \TicketSwap\Assessment\Service\TicketService::compareBarcodes
     * @group listing
     * @test
     */
    public function itShouldBePossibleToCompareTwoTicketForFindingIsThereSimilarBarcodesOrNot()
    {
        $ticketA = new Ticket(
            new TicketId(id: '6293BB44-3456-4E2A-ACA8-8CDF01AF401B'),
            [
                new Barcode(type: 'EAN-16', value: '38974312923'),
                new Barcode(type: 'EAN-89', value: '23456789456'),
            ]
        );

        $ticketB = new Ticket(
            new TicketId(id: '6293BB44-3456-4E2A-ACA8-8CDF01AF401B'),
            [
                new Barcode(type: 'EAN-13', value: '38974312923'),
                new Barcode(type: 'EAN-16', value: '38974312923'),
            ]
        );

        $hasMatch = $this->ticketService->compareBarcodes($ticketA, $ticketB);
        $this->assertTrue($hasMatch, 'Has similar matched barcodes');
    }

}