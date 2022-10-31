<?php

namespace TicketSwap\Assessment\tests\Entity;

use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use TicketSwap\Assessment\Entity\Administrator;
use TicketSwap\Assessment\Entity\Decorators\Barcode;
use TicketSwap\Assessment\Entity\Decorators\ListingId;
use TicketSwap\Assessment\Entity\Decorators\TicketId;
use TicketSwap\Assessment\Entity\Listing;
use TicketSwap\Assessment\Entity\Seller;
use TicketSwap\Assessment\Entity\Ticket;
use TicketSwap\Assessment\tests\MockData\Listings\PascalListingWithOneTicketNoBuyer;
use TicketSwap\Assessment\tests\MockData\Listings\PascalListingWithTwoTicketsNoBuyer;
use TicketSwap\Assessment\tests\MockData\Tickets\TicketWithThreeBarcodesExample;

class ListingTest extends TestCase
{
    /**
     * Business Rule: It should be possible to create a listing
     * @covers \TicketSwap\Assessment\Entity\Listing::__construct
     * @group listing
     * @test
     */
    public function itShouldBePossibleToCreateAListing()
    {
        $listing = new Listing(
            id: new ListingId('D59FDCCC-7713-45EE-A050-8A553A0F1169'),
            seller: new Seller('Pascal'),
            tickets: [
                new Ticket(
                    new TicketId('6293BB44-2F5F-4E2A-ACA8-8CDF01AF401B'),
                    [new Barcode('EAN-13', '38974312923')]
                ),
            ],
            price: new Money(4950, new Currency('EUR')),
        );

        $this->assertEquals($listing->getId(), new ListingId('D59FDCCC-7713-45EE-A050-8A553A0F1169'));
        $this->assertEquals($listing->getSeller(), new Seller('Pascal'));
        $this->assertEquals($listing->getPrice(), new Money(4950, new Currency('EUR')));
        $this->assertCount(1, $listing->getTickets());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Listing::setId
     * @covers \TicketSwap\Assessment\Entity\Listing::getId
     * @group listing
     * @test
     */
    public function itShouldBePossibleToSetIdForListing()
    {
        $listing = new Listing(
            id: new ListingId('D59FDCCC-7713-45EE-A050-8A553A0F1169'),
            seller: new Seller('Pascal'),
            tickets: [
                new Ticket(
                    new TicketId('6293BB44-2F5F-4E2A-ACA8-8CDF01AF401B'),
                    [new Barcode('EAN-13', '38974312923')]
                ),
            ],
            price: new Money(4950, new Currency('EUR')),
        );

        $listing->setId(new ListingId('D59FDCCC-1234-45EE-A050-8A553A0F1169'));
        $this->assertEquals($listing->getId(), new ListingId('D59FDCCC-1234-45EE-A050-8A553A0F1169'));
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Listing::setPrice
     * @covers \TicketSwap\Assessment\Entity\Listing::getPrice
     * @group listing
     * @test
     */
    public function itShouldBePossibleToSetPriceForListing()
    {
        $listing = new Listing(
            id: new ListingId('D59FDCCC-7713-45EE-A050-8A553A0F1169'),
            seller: new Seller('Pascal'),
            tickets: [
                new Ticket(
                    new TicketId('6293BB44-2F5F-4E2A-ACA8-8CDF01AF401B'),
                    [new Barcode('EAN-13', '38974312923')]
                ),
            ],
            price: new Money(4950, new Currency('EUR')),
        );

        $listing->setPrice(new Money(23456, new Currency('USD')));
        $this->assertEquals($listing->getPrice(), new Money(23456, new Currency('USD')));
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Listing::setSeller
     * @covers \TicketSwap\Assessment\Entity\Listing::getSeller
     * @group listing
     * @test
     */
    public function itShouldBePossibleToSetSellerForListing()
    {
        $listing = new Listing(
            id: new ListingId('D59FDCCC-7713-45EE-A050-8A553A0F1169'),
            seller: new Seller('Pascal'),
            tickets: [
                new Ticket(
                    new TicketId('6293BB44-2F5F-4E2A-ACA8-8CDF01AF401B'),
                    [new Barcode('EAN-13', '38974312923')]
                ),
            ],
            price: new Money(4950, new Currency('EUR')),
        );

        $listing->setSeller(new Seller('Tom'));
        $this->assertEquals('Tom', $listing->getSeller()->getName());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Listing::setTickets
     * @covers \TicketSwap\Assessment\Entity\Listing::getTickets
     * @group listing
     * @test
     */
    public function itShouldBePossibleToSetTicketsForListing()
    {
        $listing = new Listing(
            id: new ListingId('D59FDCCC-7713-45EE-A050-8A553A0F1169'),
            seller: new Seller('Pascal'),
            tickets: [],
            price: new Money(4950, new Currency('EUR')),
        );

        $listing->setTickets([
            new Ticket(
                new TicketId('234567-2F5F-4E2A-ACA8-8CDF01AF401B'),
                [new Barcode('EAN-16', '234567890')]
            ),
            new Ticket(
                new TicketId('6293BB44-2F5F-4E2A-SDFGH-8CDF01AF401B'),
                [new Barcode('EAN-13', '38974312923')]
            ),
        ]);
        $this->assertCount(2, $listing->getTickets());
    }


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
     * @covers \TicketSwap\Assessment\Entity\Listing::getAdministrator
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

    /**
     * Business Rule: It should not be able to set admin for list.
     * @covers \TicketSwap\Assessment\Entity\Listing::isApproveByAdmin
     * @group listing
     * @test
     */
    public function isShouldBeAbleGetTheAdminApprovedTheList()
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

        $this->assertTrue($listing->isApproveByAdmin());
    }

    /**
     * Business Rule: It should not be able to set admin for list.
     * @covers \TicketSwap\Assessment\Entity\Listing::isApproveByAdmin
     * @group listing
     * @test
     */
    public function isShouldBeAbleGetTheAdminNotApprovedTheList()
    {
        $listing = (new PascalListingWithTwoTicketsNoBuyer())->getListing();
        $this->assertFalse($listing->isApproveByAdmin());
    }
}
