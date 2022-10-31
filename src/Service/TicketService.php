<?php

namespace TicketSwap\Assessment\Service;

use TicketSwap\Assessment\Entity\Ticket;

class TicketService
{
    /**
     * @param Ticket $currentTicket
     * @param Ticket $newTicket
     * @return bool
     */
    public function compareBarcodes(
        Ticket $currentTicket,
        Ticket $newTicket
    ): bool {
        foreach ($currentTicket->getBarcodes() as $currentBarcode) {
            if (in_array((string)$currentBarcode, $newTicket->getBarcodes())) {
                return true;
            }
        }
        return false;
    }
}
