<?php

namespace TicketSwap\Assessment\tests;

use PHPUnit\Framework\TestCase;
use TicketSwap\Assessment\Service\ListingService;
use TicketSwap\Assessment\tests\MockData\Listings\PascalListingWithOneTicketNoBuyer;
use TicketSwap\Assessment\tests\MockData\Listings\PascalListingWithTwoTicketsNoBuyer;
use TicketSwap\Assessment\tests\MockData\Listings\PascalListingWithTwoTicketsOneBuyer;
use TicketSwap\Assessment\tests\MockData\TicketExample;

class ListingTest extends TestCase
{
    /**
     * Business Rule: It should be possible to create a list
     * @test
     */
    public function itShouldBePossibleToCreateAListing()
    {
        $listingService = new ListingService();
        $listing = (new PascalListingWithOneTicketNoBuyer())->getListing();

        $this->assertCount(1, $listingService->buildTicketsForBuy($listing->getTickets()));
    }

    /** Business Rule: It should not be possible to create a listing with duplicate barcodes in it.
     * @test
     */
    public function itShouldNotBePossibleToCreateAListingWithDuplicateBarcodes()
    {

        $listing = (new PascalListingWithOneTicketNoBuyer())->getListing();

        $addToTickets = $listing->addToTickets(
            (new TicketExample())->getTicket()
        );

        $this->assertFalse($addToTickets, 'Can not add similar ticket again');
    }

    /** Business Rule: It should not be possible to create a listing with duplicate barcodes in it.
     * @test
     */
    public function itShouldNotBePossibleToCreateAListingWithDuplicateBarcodesInitialTest()
    {
        $listing = (new PascalListingWithTwoTicketsNoBuyer())->getListing();

        $this->assertCount(1, $listing->getTickets());
    }

    /**
     * Business Rule: It should be possible for create a list of tickets for sale
     * @test
     */
    public function itShouldListTheTicketsForSale()
    {
        $listing = (new PascalListingWithTwoTicketsOneBuyer())->getListing();
        $listingService = new ListingService();
        $ticketsForSale = $listingService->buildTicketsForBuy($listing->getTickets(), true);

        $this->assertCount(1, $ticketsForSale);
        $this->assertSame('B47CBE2D-9F80-47D9-A9CC-894CE82AA6BA', (string)$ticketsForSale[0]->getId());
    }

    /**
     * Business Rule: It should be possible for create a list of tickets NOT for sale
     * @test
     */
    public function itShouldListTheTicketsNotForSale()
    {
        $listing = (new PascalListingWithTwoTicketsOneBuyer())->getListing();
        $listingService = new ListingService();
        $ticketsNotForSale = $listingService->buildTicketsForBuy($listing->getTickets(), false);

        $this->assertCount(1, $ticketsNotForSale);
        $this->assertSame('6293BB44-2F5F-4E2A-ACA8-8CDF01AF401B', (string)$ticketsNotForSale[0]->getId());
    }
}
