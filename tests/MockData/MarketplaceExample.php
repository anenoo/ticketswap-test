<?php

namespace TicketSwap\Assessment\tests\MockData;

use TicketSwap\Assessment\Entity\Marketplace;
use TicketSwap\Assessment\tests\MockData\Listings\PascalListingWithOneTicketNoBuyer;

class MarketplaceExample
{
    private Marketplace $marketplace;

    public function __construct()
    {
        $this->setMarketplace(
            new Marketplace(
                listingsForSale: [
                    (new PascalListingWithOneTicketNoBuyer())->getListing(),
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
     * @return MarketplaceExample
     */
    public function setMarketplace(Marketplace $marketplace): MarketplaceExample
    {
        $this->marketplace = $marketplace;
        return $this;
    }

}