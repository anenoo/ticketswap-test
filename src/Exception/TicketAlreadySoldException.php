<?php

namespace TicketSwap\Assessment\Exception;

use Exception;
use TicketSwap\Assessment\Entity\Ticket;

class TicketAlreadySoldException extends Exception
{
    /**
     * @param Ticket $ticket
     * @return static
     */
    public static function withTicket(Ticket $ticket): self
    {
        return new self(
            sprintf(
                'Ticket (%s) has already been sold',
                (string)$ticket->getId()
            )
        );
    }
}
