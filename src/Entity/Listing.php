<?php

namespace TicketSwap\Assessment\Entity;

use Money\Money;
use TicketSwap\Assessment\Entity\Decorators\ListingId;
use TicketSwap\Assessment\Service\ListingService;

final class Listing
{
    private ListingId $id;
    /**
     * Business Rule: Sellers can create listings with tickets.
     * @var Seller
     */
    private Seller $seller;
    /**
     * Business Rule: A listing contains multiple tickets.
     * @var array
     */
    private array $tickets = [];
    private Money $price;

    /**
     * @param array<Ticket> $tickets
     */
    public function __construct(
        ListingId $id,
        Seller    $seller,
        array     $tickets,
        Money     $price
    )
    {
        $this->setId($id);
        $this->setSeller($seller);
        $this->setTickets($tickets);
        $this->setPrice($price);
    }

    /**
     * @return ListingId
     */
    public function getId(): ListingId
    {
        return $this->id;
    }

    /**
     * @param ListingId $id
     * @return Listing
     */
    public function setId(ListingId $id): Listing
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Seller
     */
    public function getSeller(): Seller
    {
        return $this->seller;
    }

    /**
     * @param Seller $seller
     * @return Listing
     */
    public function setSeller(Seller $seller): Listing
    {
        $this->seller = $seller;
        return $this;
    }

    /**
     * @return Money
     */
    public function getPrice(): Money
    {
        return $this->price;
    }

    /**
     * @param Money $price
     * @return Listing
     */
    public function setPrice(Money $price): Listing
    {
        $this->price = $price;
        return $this;
    }


    /**
     * @return array<Ticket>
     */
    public function getTickets(): array
    {
        return $this->tickets;
    }

    /**
     * @param array $tickets
     * @return Listing
     */
    public function setTickets(array $tickets): Listing
    {
        foreach ($tickets as $newTicket) {
            $this->addToTickets($newTicket);
        }
        return $this;
    }

    public function addToTickets(Ticket $ticket): bool
    {
        if (count($this->tickets)) {
            $listingService = new ListingService();
            foreach ($this->tickets as $currentTicket) {
                if ($listingService->compareBarcodes($currentTicket, $ticket)) {
                    return false;
                }
            }
        }
        $this->tickets[] = $ticket;
        return true;

    }
}
