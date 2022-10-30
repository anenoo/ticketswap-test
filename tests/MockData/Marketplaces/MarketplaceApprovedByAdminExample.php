<?php

namespace TicketSwap\Assessment\tests\MockData\Marketplaces;

use TicketSwap\Assessment\Entity\Marketplace;
use TicketSwap\Assessment\tests\MockData\Listings\PascalListingWithOneTicketNoBuyerWithAdministrator;

class MarketplaceApprovedByAdminExample
{
    private Marketplace $marketplace;

    public function __construct()
    {
        $this->setMarketplace(
            new Marketplace(
                listingsForSale: [
                    (new PascalListingWithOneTicketNoBuyerWithAdministrator())->getListing(),
                ]
            )
        );
    }

    /**
     * @return Marketplace
     */
    public function getMarketplace(): Marketplace
    {
        return $this->marketplace;
    }

    /**
     * @param Marketplace $marketplace
     * @return MarketplaceApprovedByAdminExample
     */
    public function setMarketplace(Marketplace $marketplace): MarketplaceApprovedByAdminExample
    {
        $this->marketplace = $marketplace;
        return $this;
    }

}