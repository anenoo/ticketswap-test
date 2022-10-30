<?php

namespace TicketSwap\Assessment\tests\Entity;

use PHPUnit\Framework\TestCase;
use TicketSwap\Assessment\Entity\Buyer;
use TicketSwap\Assessment\Entity\Decorators\Barcode;
use TicketSwap\Assessment\Entity\Decorators\TicketId;
use TicketSwap\Assessment\Entity\Marketplace;
use TicketSwap\Assessment\Entity\Ticket;
use TicketSwap\Assessment\Exception\TicketAlreadySoldException;
use TicketSwap\Assessment\Service\MarketplaceService;
use TicketSwap\Assessment\tests\MockData\Listings\MariyaListingWithOneTicket;
use TicketSwap\Assessment\tests\MockData\Marketplaces\MarketplaceApprovedByAdminExample;
use TicketSwap\Assessment\tests\MockData\Marketplaces\MarketplaceTicketWithBuyerExample;
use TicketSwap\Assessment\tests\MockData\Marketplaces\MarketplaceWithDuplicateTicketsExample;

class MarketplaceServiceTest extends TestCase
{
    /**
     * @var MarketplaceService
     */
    private MarketplaceService $marketPlaceService;
    /**
     * @var Marketplace
     */
    private Marketplace $MarketplaceApprovedByAdminExample;
    /**
     * @var Marketplace
     */
    private Marketplace $MarketplaceWithDuplicateTicketsExample;
    /**
     * @var Marketplace
     */
    private Marketplace $MarketplaceTicketWithBuyerExample;

    /**
     * @before
     */
    public function setupInitial()
    {
        $this->marketPlaceService = new MarketplaceService();
        $this->MarketplaceApprovedByAdminExample = (new MarketplaceApprovedByAdminExample())->getMarketplace();
        $this->MarketplaceWithDuplicateTicketsExample = (new MarketplaceWithDuplicateTicketsExample())->getMarketplace();
        $this->MarketplaceTicketWithBuyerExample = (new MarketplaceTicketWithBuyerExample())->getMarketplace();
    }

    /**
     * Business Rule: Buyers can buy individual tickets from a listing, while admin approved the list.
     * @covers \TicketSwap\Assessment\Service\MarketplaceService::buyTicket
     * @group marketplace
     * @test
     */
    public function itShouldBePossibleToBuyATicketWhileAdminApprovedList()
    {
        $marketplace = $this->MarketplaceApprovedByAdminExample;

        $boughtTicket = $this->marketPlaceService->buyTicket(
            marketplace: $marketplace,
            buyer: new Buyer(name: 'Sarah'),
            ticketId: new TicketId(id: '6293BB44-2F5F-4E2A-ACA8-8CDF01AF401B')
        );
        $barcode = $boughtTicket->getBarcodes()[0];
        $this->assertNotNull($boughtTicket);
        $this->assertSame('EAN-13:38974312923', (string)$barcode);
    }

    /**
     * Business Rule: It should not be possible to buy the same ticket twice.
     * The list is approved by admin.
     * @covers \TicketSwap\Assessment\Service\MarketplaceService::buyTicket
     * @group marketplace
     * @test
     */
    public function itShouldNotBePossibleToBuyTheSameTicketTwice()
    {
        $marketplace = $this->MarketplaceWithDuplicateTicketsExample;

        $buyer = new Buyer('Sarah');
        $ticketId = new TicketId('6293BB44-2F5F-4E2A-ACA8-8CDF01AF401B');
        $barcode = new Barcode('EAN-13', '38974312923');

        $ticket = $this->marketPlaceService->buyTicket(
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
     * Business Rule: It should not be possible to create a listing with duplicate barcodes within another listing.
     * The list is approved by Admin.
     * @covers \TicketSwap\Assessment\Service\MarketplaceService::checkTheTicketAlreadyAdded
     * @group marketplace
     * @test
     */
    public function itShouldNotBePossibleToSellATicketWithABarcodeThatIsAlreadyForSale()
    {
        $marketplace = $this->MarketplaceApprovedByAdminExample;

        $canBeAdd = $this->marketPlaceService->checkTheTicketAlreadyAdded(
            listing: (new MariyaListingWithOneTicket())->getListing(),
            marketplace: $marketplace
        );
        $this->assertFalse($canBeAdd, "Can not add a ticket twice");
    }

    /**
     * Business Rule: I should be possible for the last buyer of a ticket, to create a listing with that ticket
     * (based on barcode).
     * The list is approved by Admin.
     * @covers \TicketSwap\Assessment\Service\MarketplaceService::checkTheTicketAlreadyAdded
     * @group marketplace
     * @test
     */
    public function itShouldBePossibleForABuyerOfATicketToSellItAgain()
    {
        $marketplace = $this->MarketplaceTicketWithBuyerExample;

        $canBeAdd = $this->marketPlaceService->checkTheTicketAlreadyAdded(
            listing: (new MariyaListingWithOneTicket())->getListing(),
            marketplace: $marketplace
        );
        $this->assertTrue($canBeAdd, 'Can sell the same ticket he/she buy');

    }

    /**
     * Business Rule: Once all tickets have been sold for a listing, it is no longer for sale.
     * The list is approved by Admin.
     * @covers \TicketSwap\Assessment\Service\MarketplaceService::buyTicket
     * @group marketplace
     * @test
     */
    public function itShouldBePossibleToRemoveListIfAllTickedSoled()
    {
        $marketplace = $this->MarketplaceApprovedByAdminExample;

        $ticket = $this->marketPlaceService->buyTicket(
            marketplace: $marketplace,
            buyer: new Buyer('Sarah'),
            ticketId: new TicketId('6293BB44-2F5F-4E2A-ACA8-8CDF01AF401B')
        );
        $this->assertInstanceOf(Ticket::class, $ticket);
        $this->assertCount(0, $marketplace->getListingsForSale());

    }
}
