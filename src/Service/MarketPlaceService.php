<?php

namespace TicketSwap\Assessment\Service;

use TicketSwap\Assessment\Entity\Buyer;
use TicketSwap\Assessment\Entity\Decorators\TicketId;
use TicketSwap\Assessment\Entity\Listing;
use TicketSwap\Assessment\Entity\Marketplace;
use TicketSwap\Assessment\Entity\Seller;
use TicketSwap\Assessment\Entity\Ticket;

/**
 *
 */
class MarketPlaceService
{
    /**
     *
     */
    function __construct()
    {
    }

    /**
     * @param Marketplace $marketplace
     * @param Buyer $buyer
     * @param TicketId $ticketId
     * @return Ticket|null
     */
    public function buyTicket(
        Marketplace $marketplace,
        Buyer       $buyer,
        TicketId    $ticketId
    ): ?Ticket
    {
        $isThereMoreTicket = 0;
        $findTheTicket = null;
        foreach ($marketplace->getListingsForSale() as $listingKey => $listing) {
            list($isThereMoreTicket, $findTheTicket) = $this->searchListToBuyTicket(
                $listing,
                $isThereMoreTicket,
                $ticketId,
                $buyer,
                $findTheTicket,
                $marketplace,
                $listingKey
            );
        }
        $this->emptyMarketPlaceIfItNeeds($isThereMoreTicket, $findTheTicket, $marketplace);
        return $findTheTicket;
    }

    /**
     * @param Listing $listing
     * @param int $isThereMoreTicket
     * @param TicketId $ticketId
     * @param Buyer $buyer
     * @param Ticket $findTheTicket
     * @param Marketplace $marketplace
     * @param int|string $listingKey
     * @return array
     */
    public function searchListToBuyTicket(
        Listing     $listing,
        int         $isThereMoreTicket,
        TicketId    $ticketId,
        Buyer       $buyer,
        ?Ticket     $findTheTicket,
        Marketplace $marketplace,
        int|string  $listingKey
    ): array
    {
        foreach ($listing->getTickets() as $ticket) {
            $isThereMoreTicket++;
            if ($this->ticketIsAvailableByTheBuyer(
                $ticket,
                $listing,
                $ticketId,
                $buyer
            )) {
                $findTheTicket = $ticket->setBuyer($buyer);
                if (count($listing->getTickets()) === 1) {
                    $marketplace->removeFromListForSale($listingKey);
                }
            }
        }
        return array($isThereMoreTicket, $findTheTicket);
    }

    /**
     * @param Ticket $ticket
     * @param Listing $listing
     * @param TicketId $ticketId
     * @return bool
     */
    private function ticketIsAvailableByTheBuyer(
        Ticket   $ticket,
        Listing  $listing,
        TicketId $ticketId,
        Buyer    $buyer
    ): bool
    {
        return (
            $ticket->getId()->equals($ticketId)
            && (
                !$ticket->getBuyer()?->getName()
                || $buyer?->getName() == $listing->getSeller()->getName()
            )
        );
    }

    /**
     * @param int $isThereMoreTicket
     * @param Ticket|null $findTheTicket
     * @param Marketplace $marketplace
     * @return void
     */
    public function emptyMarketPlaceIfItNeeds(
        int         $isThereMoreTicket,
        ?Ticket     $findTheTicket,
        Marketplace $marketplace
    ): void
    {
        if ($isThereMoreTicket === 1 && $findTheTicket instanceof Ticket) {
            $marketplace->emptyListingForSales();
        }
    }

    /**
     * @param Listing $listing
     * @param Marketplace $marketplace
     * @return bool
     */
    public function checkTheTicketAlreadyAdded(
        Listing     $listing,
        Marketplace $marketplace
    ): bool
    {
        foreach ($marketplace->getListingsForSale() as $list) {
            foreach ($list->getTickets() as $currentTicket) {
                foreach ($listing->getTickets() as $newTicket) {
                    if ($this->compareTicketsForNewSellListing(
                        $newTicket,
                        $currentTicket,
                        $listing->getSeller()
                    )) {
                        continue;
                    } else {
                        return false;
                    }
                }
            }
        }
        return true;
    }

    /**
     * @param Ticket $newTicket
     * @param Ticket $currentTicket
     * @param Seller $seller
     * @return bool
     */
    private function compareTicketsForNewSellListing(
        Ticket $newTicket,
        Ticket $currentTicket,
        Seller $seller
    ): bool
    {
        if ($newTicket->getBarcode() == $currentTicket->getBarcode()) {
            if (!($currentTicket->getBuyer()?->getName()
                && $currentTicket->getBuyer()?->getName() === $seller?->getName())) {
                return false;
            }
        }
        return true;
    }

}