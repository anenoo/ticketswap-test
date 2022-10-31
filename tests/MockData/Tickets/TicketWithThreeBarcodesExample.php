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
                new TicketId(id: '6293BB44-2F5F-4E2A-ACA8-8CDF01AF401B'),
                [
                    new Barcode(type: 'EAN-13', value: '38974312923'),
                    new Barcode(type: 'EAN-89', value: '23456789456'),
                    new Barcode(type: 'EAN-67', value: '45678903456'),
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
