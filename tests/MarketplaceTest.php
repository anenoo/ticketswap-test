<?php

namespace TicketSwap\Assessment\tests;

use PHPUnit\Framework\TestCase;
use TicketSwap\Assessment\Entity\Buyer;
use TicketSwap\Assessment\Entity\Decorators\Barcode;
use TicketSwap\Assessment\Entity\Decorators\TicketId;
use TicketSwap\Assessment\Entity\Marketplace;
use TicketSwap\Assessment\Entity\Ticket;
use TicketSwap\Assessment\Exception\TicketAlreadySoldException;
use TicketSwap\Assessment\Service\MarketPlaceService;
use TicketSwap\Assessment\tests\MockData\Listings\MariyaListingWithOneTicket;
use TicketSwap\Assessment\tests\MockData\Listings\PascalListingDuplicateTicket;
use TicketSwap\Assessment\tests\MockData\Listings\PascalListingWithOneTicketOneBuyer;
use TicketSwap\Assessment\tests\MockData\Listings\TomListingOneTicketNoBuyer;
use TicketSwap\Assessment\tests\MockData\Marketplaces\MarketplaceExample;

class MarketplaceTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldListAllTheTicketsForSale()
    {
        $marketplace = (new MarketplaceExample())->getMarketplace();
        $listingsForSale = $marketplace->getListingsForSale();

        $this->assertCount(1, $listingsForSale);
    }

    /**
     * Business Rule: Buyers can buy individual tickets from a listing.
     * @test
     */
    public function itShouldBePossibleToBuyATicket()
    {
        $marketPlaceService = new MarketPlaceService();
        $marketplace = (new MarketplaceExample())->getMarketplace();

        $boughtTicket = $marketPlaceService->buyTicket(
            marketplace: $marketplace,
            buyer: new Buyer('Sarah'),
            ticketId: new TicketId('6293BB44-2F5F-4E2A-ACA8-8CDF01AF401B')
        );
        $barcode = $boughtTicket->getBarcodes()[0];
        $this->assertNotNull($boughtTicket);
        $this->assertSame('EAN-13:38974312923', (string)$barcode);
    }

    /**
     * @test
     */
    public function itShouldNotBePossibleToBuyTheSameTicketTwice()
    {
        $marketPlaceService = new MarketPlaceService();
        $marketplace = new Marketplace(
            listingsForSale: [
                (new PascalListingDuplicateTicket())->getListing()
            ]
        );

        $buyer = new Buyer('Sarah');
        $ticketId = new TicketId('6293BB44-2F5F-4E2A-ACA8-8CDF01AF401B');
        $barcode = new Barcode('EAN-13', '38974312923');

        $ticket = $marketPlaceService->buyTicket(
            marketplace: $marketplace,
            buyer: $buyer,
            ticketId: $ticketId
        );

        if (!($ticket instanceof Ticket)) {
            $ticketAlreadySoldException = new TicketAlreadySoldException();
            $message = $ticketAlreadySoldException->withTicket(
                new Ticket(
                    id: $ticketId,
                    barcodes: [$barcode],
                    buyer: $buyer
                )
            );
            $this->assertNull($ticket, $message);
        }
    }

    /**
     * Business Rule: Sellers can create listings with tickets.
     * @test
     */
    public function itShouldBePossibleToPutAListingForSale()
    {
        $marketplace = (new MarketplaceExample())->getMarketplace();

        $marketplace->addToListForSale(
            (new TomListingOneTicketNoBuyer())->getListing()
        );

        $listingsForSale = $marketplace->getListingsForSale();

        $this->assertCount(2, $listingsForSale);
    }

    /**
     * Business Rule: It should not be possible to create a listing with duplicate barcodes within another listing.
     * @test
     */
    public function itShouldNotBePossibleToSellATicketWithABarcodeThatIsAlreadyForSale()
    {
        $marketplace = (new MarketplaceExample())->getMarketplace();

        $marketPlaceService = new MarketPlaceService();
        $canBeAdd = $marketPlaceService->checkTheTicketAlreadyAdded(
            listing: (new MariyaListingWithOneTicket())->getListing(),
            marketplace: $marketplace
        );
        $this->assertFalse($canBeAdd, "Can not add a ticket twice");
    }

    /**
     * Business Rule: I should be possible for the last buyer of a ticket, to create a listing with that ticket
     * (based on barcode).
     * @test
     */
    public function itShouldBePossibleForABuyerOfATicketToSellItAgain()
    {
        $marketplace = new Marketplace(
            listingsForSale: [
                (new PascalListingWithOneTicketOneBuyer())->getListing()
            ]
        );

        $marketPlaceService = new MarketPlaceService();
        $canBeAdd = $marketPlaceService->checkTheTicketAlreadyAdded(
            listing: (new MariyaListingWithOneTicket())->getListing(),
            marketplace: $marketplace
        );
        $this->assertTrue($canBeAdd, 'Can sell the same ticket he/she buy');

    }

    /**
     * Business Rule: Once all tickets have been sold for a listing, it is no longer for sale.
     * @test
     */
    public function itShouldBePossibleToRemoveListIfAllTickedSoled()
    {
        $marketPlaceService = new MarketPlaceService();
        $marketplace = (new MarketplaceExample())->getMarketplace();

        $ticket = $marketPlaceService->buyTicket(
            marketplace: $marketplace,
            buyer: new Buyer('Sarah'),
            ticketId: new TicketId('6293BB44-2F5F-4E2A-ACA8-8CDF01AF401B')
        );
        $this->assertInstanceOf(Ticket::class, $ticket);
        $this->assertCount(0, $marketplace->getListingsForSale());

    }
}
