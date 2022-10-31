<?php

namespace TicketSwap\Assessment\tests\MockData\Listings;

use Money\Currency;
use Money\Money;
use TicketSwap\Assessment\Entity\Decorators\Barcode;
use TicketSwap\Assessment\Entity\Decorators\ListingId;
use TicketSwap\Assessment\Entity\Decorators\TicketId;
use TicketSwap\Assessment\Entity\Listing;
use TicketSwap\Assessment\Entity\Seller;
use TicketSwap\Assessment\Entity\Ticket;

class TomListingOneTicketNoBuyer
{
    public Listing $listing;

    public function __construct()
    {
        $this->setListing(
            new Listing(
                id: new ListingId('26A7E5C4-3F59-4B3C-B5EB-6F2718BC31AD'),
                seller: new Seller(name: 'Tom'),
                tickets: [
                    new Ticket(
                        id: new TicketId('45B96761-E533-4925-859F-3CA62182848E'),
                        barcodes: [new Barcode('EAN-13', '893759834')]
                    ),
                ],
                price: new Money(4950, new Currency('EUR'))
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
     * @return TomListingOneTicketNoBuyer
     */
    public function setListing(Listing $listing): TomListingOneTicketNoBuyer
    {
        $this->listing = $listing;
        return $this;
    }
}
