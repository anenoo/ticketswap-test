<?php

namespace TicketSwap\Assessment\tests\Entity;

use PHPUnit\Framework\TestCase;
use TicketSwap\Assessment\Service\ListingService;
use TicketSwap\Assessment\tests\MockData\Listings\PascalListingWithOneTicketNoBuyer;
use TicketSwap\Assessment\tests\MockData\Listings\PascalListingWithTwoTicketsOneBuyer;

class ListingServiceTest extends TestCase
{
    /**
     * Business Rule: It should be possible to create a list
     * @covers \TicketSwap\Assessment\Service\ListingService::buildTicketsForBuy
     * @group listing
     * @test
     */
    public function itShouldBePossibleToCreateAListing()
    {
        $listingService = new ListingService();
        $listing = (new PascalListingWithOneTicketNoBuyer())->getListing();
        $getTicketsForBuy = $listingService->buildTicketsForBuy($listing->getTickets());

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

        $listingService = new ListingService();
        $listing = (new PascalListingWithTwoTicketsOneBuyer())->getListing();
        $ticketsForSale = $listingService->buildTicketsForBuy($listing->getTickets(), true);

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

        $listingService = new ListingService();
        $listing = (new PascalListingWithTwoTicketsOneBuyer())->getListing();
        $ticketsNotForSale = $listingService->buildTicketsForBuy($listing->getTickets(), false);

        $this->assertCount(1, $ticketsNotForSale);
        $this->assertSame('6293BB44-2F5F-4E2A-ACA8-8CDF01AF401B', (string)$ticketsNotForSale[0]->getId());
    }

}
