<?php

namespace TicketSwap\Assessment\Service;

use TicketSwap\Assessment\Entity\Ticket;

/**
 *
 */
class ListingService
{
    /**
     *
     */
    function __construct()
    {
    }

    /**
     * @param array<Ticket> $tickets
     * @param bool|null $forSale
     * @return array
     */
    public function buildTicketsForBuy(
        array $tickets,
        ?bool $forSale = null
    ): array
    {
        if (null !== $forSale) {
            $convertedTicketList = [];
            foreach ($tickets as $ticket) {
                if ($this->availableToBuy($forSale, $ticket)) {
                    $convertedTicketList[] = $ticket;
                }
            }
            return $convertedTicketList;
        }
        return $tickets;
    }

    /**
     * @param bool $forSale
     * @param Ticket $ticket
     * @return bool
     */
    public function availableToBuy(
        bool   $forSale,
        Ticket $ticket
    ): bool
    {
        return (true === $forSale && !$ticket->isBought()) || (false === $forSale && $ticket->isBought());
    }

    /**
     * @param Ticket $currentTicket
     * @param Ticket $newTicket
     * @return bool
     */
    public function compareBarcodes(
        Ticket $currentTicket,
        Ticket $newTicket
    ): bool
    {
        foreach ($currentTicket->getBarcodes() as $currentBarcode) {
            if (in_array((string)$currentBarcode, $newTicket->getBarcodes())) {
                return true;
            }
        }
        return false;
    }

}