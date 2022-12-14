<?php

namespace TicketSwap\Assessment\tests\Entity;

use PHPUnit\Framework\TestCase;
use TicketSwap\Assessment\Entity\Decorators\Barcode;
use TicketSwap\Assessment\Entity\Decorators\TicketId;
use TicketSwap\Assessment\Entity\Listing;
use TicketSwap\Assessment\Entity\Ticket;
use TicketSwap\Assessment\Service\ListingService;
use TicketSwap\Assessment\tests\MockData\Listings\PascalListingWithOneTicketNoBuyer;
use TicketSwap\Assessment\tests\MockData\Listings\PascalListingWithTwoTicketsOneBuyer;

class ListingServiceTest extends TestCase
{
    /**
     * @var ListingService
     */
    private ListingService $listingService;
    /**
     * @var Listing
     */
    private Listing $PascalListingWithOneTicketNoBuyer;
    /**
     * @var Listing
     */
    private Listing $PascalListingWithTwoTicketsOneBuyer;

    /**
     * @before
     */
    public function setupInitial()
    {
        $this->listingService = new ListingService();
        $this->PascalListingWithOneTicketNoBuyer = (new PascalListingWithOneTicketNoBuyer())->getListing();
        $this->PascalListingWithTwoTicketsOneBuyer = (new PascalListingWithTwoTicketsOneBuyer())->getListing();
    }

    /**
     * Business Rule: It should be possible to create a list
     * @covers \TicketSwap\Assessment\Service\ListingService::buildTicketsForBuy
     * @group listing
     * @test
     */
    public function itShouldBePossibleToCreateAListing()
    {
        $listing = $this->PascalListingWithOneTicketNoBuyer;
        $getTicketsForBuy = $this->listingService->buildTicketsForBuy($listing->getTickets());

        $this->assertCount(1, $getTicketsForBuy);
    }

    /**
     * Business Rule: It should be possible for create a list of tickets for sale
     * @covers \TicketSwap\Assessment\Service\ListingService::buildTicketsForBuy
     * @group listing
     * @test
     */
    public function itShouldListTheTicketsForSale()
    {
        $listing = $this->PascalListingWithTwoTicketsOneBuyer;
        $ticketsForSale = $this->listingService->buildTicketsForBuy($listing->getTickets(), true);

        $this->assertCount(1, $ticketsForSale);
        $this->assertSame('B47CBE2D-9F80-47D9-A9CC-894CE82AA6BA', (string)$ticketsForSale[0]->getId());
    }

    /**
     * Business Rule: It should be possible for create a list of tickets NOT for sale
     * @covers \TicketSwap\Assessment\Service\ListingService::buildTicketsForBuy
     * @group listing
     * @test
     */
    public function itShouldListTheTicketsNotForSale()
    {
        $listing = $this->PascalListingWithTwoTicketsOneBuyer;
        $ticketsNotForSale = $this->listingService->buildTicketsForBuy($listing->getTickets(), false);

        $this->assertCount(1, $ticketsNotForSale);
        $this->assertSame('6293BB44-2F5F-4E2A-ACA8-8CDF01AF401B', (string)$ticketsNotForSale[0]->getId());
    }

    /**
     * Business Rule: It should be possible for create a list of tickets NOT for sale
     * @covers \TicketSwap\Assessment\Service\ListingService::availableToBuy
     * @group listing
     * @test
     */
    public function itShouldBePossibleToCheckAvailabilityForSaleATTicket()
    {
        $availableForSale = $this->listingService->availableToBuy(
            true,
            new Ticket(
                new TicketId(id: 'B47CBE2D-9F80-47D9-A9CC-894CE82AA6BA'),
                [new Barcode(type: 'EAN-13', value: '38957953498')]
            )
        );
        $this->assertTrue($availableForSale);
    }
}
