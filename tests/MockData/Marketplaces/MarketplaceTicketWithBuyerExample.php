<?php

namespace TicketSwap\Assessment\tests\MockData\Marketplaces;

use TicketSwap\Assessment\Entity\Marketplace;
use TicketSwap\Assessment\tests\MockData\Listings\PascalListingWithOneTicketOneBuyer;

class MarketplaceTicketWithBuyerExample
{
    private Marketplace $marketplace;

    public function __construct()
    {
        $this->setMarketplace(
            new Marketplace(
                listingsForSale: [
                    (new PascalListingWithOneTicketOneBuyer())->getListing(),
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
     * @return MarketplaceTicketWithBuyerExample
     */
    public function setMarketplace(Marketplace $marketplace): MarketplaceTicketWithBuyerExample
    {
        $this->marketplace = $marketplace;
        return $this;
    }

}