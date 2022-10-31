<?php

namespace TicketSwap\Assessment\tests\Entity\Decorators;

use PHPUnit\Framework\TestCase;
use TicketSwap\Assessment\Entity\Decorators\ListingId;

class ListingIdTest extends TestCase
{
    /**
     * @covers \TicketSwap\Assessment\Entity\Decorators\ListingId::__construct
     * @group listingId
     * @test
     */
    public function itShouldBePossibleToCreateBarcode()
    {
        $listingId = new ListingId(id: '234567890');
        $this->assertEquals('234567890', (string)$listingId);
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Decorators\ListingId::__toString
     * @group listingId
     * @test
     */
    public function itShouldBePossibleToGetStringValueForListingId()
    {
        $listingId = new ListingId(id: '234567890');
        $this->assertEquals('234567890', $listingId->__toString());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Decorators\ListingId::setId
     * @group listingId
     * @test
     */
    public function itShouldBePossibleToSetNewIdForListing()
    {
        $listingId = new ListingId(id: '234567890');
        $listingId->setId('678902345678');
        $this->assertEquals('678902345678', $listingId->getId());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Decorators\ListingId::getId
     * @group listingId
     * @test
     */
    public function itShouldBePossibleToGetIdForListing()
    {
        $listingId = new ListingId(id: '234567890');
        $this->assertEquals('234567890', $listingId->getId());
    }
}
