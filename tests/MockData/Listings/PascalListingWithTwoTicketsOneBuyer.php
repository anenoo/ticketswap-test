<?php

namespace TicketSwap\Assessment\tests\MockData\Listings;

use Money\Currency;
use Money\Money;
use TicketSwap\Assessment\Entity\Buyer;
use TicketSwap\Assessment\Entity\Decorators\Barcode;
use TicketSwap\Assessment\Entity\Decorators\ListingId;
use TicketSwap\Assessment\Entity\Decorators\TicketId;
use TicketSwap\Assessment\Entity\Listing;
use TicketSwap\Assessment\Entity\Seller;
use TicketSwap\Assessment\Entity\Ticket;

class PascalListingWithTwoTicketsOneBuyer
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
                        new Barcode('EAN-13', '38974312923'),
                        new Buyer('Jane')
                    ),
                    new Ticket(
                        new TicketId('B47CBE2D-9F80-47D9-A9CC-894CE82AA6BA'),
                        new Barcode('EAN-13', '38957953498')
                    ),
                ],
                price: new Money(4950, new Currency('EUR')),
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
     * @return PascalListingWithTwoTicketsOneBuyer
     */
    public function setListing(Listing $listing): PascalListingWithTwoTicketsOneBuyer
    {
        $this->listing = $listing;
        return $this;
    }
}