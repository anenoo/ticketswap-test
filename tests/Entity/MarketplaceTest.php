<?php

namespace TicketSwap\Assessment\tests\Entity;

use PHPUnit\Framework\TestCase;
use TicketSwap\Assessment\tests\MockData\Listings\TomListingOneTicketNoBuyer;
use TicketSwap\Assessment\tests\MockData\Listings\TomListingOneTicketNoBuyerWithAdministrator;
use TicketSwap\Assessment\tests\MockData\Marketplaces\MarketplaceApprovedByAdminExample;
use TicketSwap\Assessment\tests\MockData\Marketplaces\MarketplaceExample;

class MarketplaceTest extends TestCase
{
    /**
     * Business Rule: It should be able to list all the tickets for sale if Admin Approve
     * @covers \TicketSwap\Assessment\Entity\Marketplace::getListingsForSale
     * @group marketplace
     * @test
     */
    public function itShouldListAllTheTicketsForSaleIfAdminApprove()
    {
        $marketplace = (new MarketplaceApprovedByAdminExample())->getMarketplace();
        $listingsForSale = $marketplace->getListingsForSale();

        $this->assertCount(1, $listingsForSale);
    }

    /**
     * Business Rule: It should be able to list all the tickets for sale if Admin Approve
     * @covers \TicketSwap\Assessment\Entity\Marketplace::getListingsForSale
     * @group marketplace
     * @test
     */
    public function itShouldNotListAllTheTicketsForSaleIfAdminDoesntApprove()
    {
        $marketplace = (new MarketplaceExample())->getMarketplace();
        $listingsForSale = $marketplace->getListingsForSale();

        $this->assertCount(0, $listingsForSale);
    }

    /**
     * Business Rule: Sellers can create listings with tickets.
     * @covers \TicketSwap\Assessment\Entity\Marketplace::addToListForSale
     * @group marketplace
     * @test
     */
    public function itShouldBePossibleToPutAListingForSaleIfAdminApprove()
    {
        $marketplace = (new MarketplaceApprovedByAdminExample())->getMarketplace();

        $marketplace->addToListForSale(
            (new TomListingOneTicketNoBuyerWithAdministrator())->getListing()
        );

        $listingsForSale = $marketplace->getListingsForSale();

        $this->assertCount(2, $listingsForSale);
    }

    /**
     * Business Rule: Sellers can create listings with tickets.
     * @covers \TicketSwap\Assessment\Entity\Marketplace::addToListForSale
     * @group marketplace
     * @test
     */
    public function itShouldNotBePossibleToPutAListingForSaleIfAminDoesntApprove()
    {
        $marketplace = (new MarketplaceApprovedByAdminExample())->getMarketplace();

        $marketplace->addToListForSale(
            (new TomListingOneTicketNoBuyer())->getListing()
        );

        $listingsForSale = $marketplace->getListingsForSale();

        $this->assertCount(1, $listingsForSale);
    }

    /**
     * Business Rule: Sellers can create listings with tickets.
     * It Should be possible to remove a list from marketplace
     * @covers \TicketSwap\Assessment\Entity\Marketplace::addToListForSale
     * @group marketplace
     * @test
     */
    public function itShouldNotBePossibleToRemoveAListingFromMarketPlace()
    {
        $marketplace = (new MarketplaceApprovedByAdminExample())->getMarketplace();

        $marketplace->addToListForSale(
            (new TomListingOneTicketNoBuyerWithAdministrator())->getListing()
        );

        $marketplace->removeFromListForSale(0);

        $listingsForSale = $marketplace->getListingsForSale();

        $this->assertCount(1, $listingsForSale);
    }


}
