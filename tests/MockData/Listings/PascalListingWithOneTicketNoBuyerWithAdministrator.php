<?php

namespace TicketSwap\Assessment\tests\MockData\Listings;

use Money\Currency;
use Money\Money;
use TicketSwap\Assessment\Entity\Administrator;
use TicketSwap\Assessment\Entity\Decorators\Barcode;
use TicketSwap\Assessment\Entity\Decorators\ListingId;
use TicketSwap\Assessment\Entity\Decorators\TicketId;
use TicketSwap\Assessment\Entity\Listing;
use TicketSwap\Assessment\Entity\Seller;
use TicketSwap\Assessment\Entity\Ticket;

class PascalListingWithOneTicketNoBuyerWithAdministrator
{
    public Listing $listing;

    public function __construct()
    {
        $this->setListing(
            new Listing(
                id: new ListingId('D59FDCCC-7713-45EE-A050-8A553A0F1169'),
                seller: new Seller('Pascal'),
                tickets: [
                    new Ticket(
                        new TicketId('6293BB44-2F5F-4E2A-ACA8-8CDF01AF401B'),
                        [new Barcode('EAN-13', '38974312923')]
                    ),
                ],
                price: new Money(4950, new Currency('EUR')),
                administrator: new Administrator(
                    id: 1,
                    name: 'Super Admin',
                    username: 'super-admin',
                    password: ''
                )
            )
        );
    }


    /**
     * @return Listing
     */
    public function getListing(): Listing
    {
        return $this->listing;
    }

    /**
     * @param Listing $listing
     * @return PascalListingWithOneTicketNoBuyerWithAdministrator
     */
    public function setListing(Listing $listing): PascalListingWithOneTicketNoBuyerWithAdministrator
    {
        $this->listing = $listing;
        return $this;
    }
}
