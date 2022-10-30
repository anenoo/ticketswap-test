<?php

namespace TicketSwap\Assessment\tests\MockData\Tickets;

use TicketSwap\Assessment\Entity\Decorators\Barcode;
use TicketSwap\Assessment\Entity\Decorators\TicketId;
use TicketSwap\Assessment\Entity\Ticket;

class TicketWithThreeBarcodesExample
{
    private Ticket $ticket;

    public function __construct()
    {
        $this->setTicket(
            new Ticket(
                new TicketId('6293BB44-2F5F-4E2A-ACA8-8CDF01AF401B'),
                [
                    new Barcode('EAN-13', '38974312923'),
                    new Barcode('EAN-89', '23456789456'),
                    new Barcode('EAN-67', '45678903456'),
                ]
            )
        );
    }

    /**
     * @return Ticket
     */
    public function getTicket(): Ticket
    {
        return $this->ticket;
    }

    /**
     * @param Ticket $ticket
     * @return TicketWithThreeBarcodesExample
     */
    public function setTicket(Ticket $ticket): TicketWithThreeBarcodesExample
    {
        $this->ticket = $ticket;
        return $this;
    }

}