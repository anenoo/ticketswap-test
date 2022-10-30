<?php

namespace TicketSwap\Assessment\tests\Entity;

use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use TicketSwap\Assessment\Entity\Administrator;
use TicketSwap\Assessment\tests\MockData\Listings\PascalListingWithOneTicketNoBuyer;
use TicketSwap\Assessment\tests\MockData\Listings\PascalListingWithTwoTicketsNoBuyer;
use TicketSwap\Assessment\tests\MockData\Tickets\TicketWithThreeBarcodesExample;

class ListingTest extends TestCase
{

    /** Business Rule: It should not be possible to create a listing with duplicate barcodes in it.
     * @covers \TicketSwap\Assessment\Entity\Listing::addToTickets
     * @group listing
     * @test
     */
    public function itShouldNotBePossibleToCreateAListingWithDuplicateBarcodes()
    {

        $listing = (new PascalListingWithOneTicketNoBuyer())->getListing();

        $addToTickets = $listing->addToTickets(
            (new TicketWithThreeBarcodesExample())->getTicket()
        );

        $this->assertFalse($addToTickets, 'Can not add similar ticket again');
    }

    /**
     * Business Rule: It should not be possible to create a listing with duplicate barcodes in initial setup.
     * @covers \TicketSwap\Assessment\Entity\Listing::getTickets
     * @group listing
     * @test
     */
    public function itShouldNotBePossibleToCreateAListingWithDuplicateBarcodesInitialTest()
    {
        $listing = (new PascalListingWithTwoTicketsNoBuyer())->getListing();

        $this->assertCount(1, $listing->getTickets());
    }

    /**
     * Business Rule: It should be able to set the price for list.
     * @covers \TicketSwap\Assessment\Entity\Listing::setPrice
     * @group listing
     * @test
     */
    public function isShouldBeAbleToSetThePriceForList()
    {
        $listing = (new PascalListingWithTwoTicketsNoBuyer())->getListing();
        $listing->setPrice(new Money(4567, new Currency('EUR')));

        $this->assertEquals(new Money(4567, new Currency('EUR')), $listing->getPrice());
    }

    /**
     * Business Rule: It should not be able to set admin for list.
     * @covers \TicketSwap\Assessment\Entity\Listing::setAdministrator
     * @group listing
     * @test
     */
    public function isShouldBeAbleToSetAdminForList()
    {
        $listing = (new PascalListingWithTwoTicketsNoBuyer())->getListing();
        $listing->setAdministrator(
            new Administrator(
                id: 2,
                name: 'Admin',
                username: 'admin',
                password: ''
            )
        );

        $this->assertEquals('Admin', $listing->getAdministrator()?->getName());
    }

}
