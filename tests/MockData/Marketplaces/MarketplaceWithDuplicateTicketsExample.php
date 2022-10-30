<?php

namespace TicketSwap\Assessment\tests\MockData\Marketplaces;

use TicketSwap\Assessment\Entity\Marketplace;
use TicketSwap\Assessment\tests\MockData\Listings\PascalListingDuplicateTicket;

class MarketplaceWithDuplicateTicketsExample
{
    private Marketplace $marketplace;

    public function __construct()
    {
        $this->setMarketplace(
            new Marketplace(
                listingsForSale: [
                    (new PascalListingDuplicateTicket())->getListing(),
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
     * @return MarketplaceWithDuplicateTicketsExample
     */
    public function setMarketplace(Marketplace $marketplace): MarketplaceWithDuplicateTicketsExample
    {
        $this->marketplace = $marketplace;
        return $this;
    }

}