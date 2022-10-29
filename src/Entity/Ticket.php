<?php

namespace TicketSwap\Assessment\Entity;

use TicketSwap\Assessment\Entity\Decorators\Barcode;
use TicketSwap\Assessment\Entity\Decorators\TicketId;

final class Ticket
{

    private TicketId $id;
    private Barcode $barcode;
    private ?Buyer $buyer = null;

    public function __construct(
        TicketId $id,
        Barcode  $barcode,
        ?Buyer   $buyer = null
    )
    {
        $this->setId($id);
        $this->setBarcode($barcode);
        $this->setBuyer($buyer);
    }

    /**
     * @return TicketId
     */
    public function getId(): TicketId
    {
        return $this->id;
    }

    /**
     * @param TicketId $id
     * @return Ticket
     */
    public function setId(TicketId $id): Ticket
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Barcode
     */
    public function getBarcode(): Barcode
    {
        return $this->barcode;
    }

    /**
     * @param Barcode $barcode
     * @return Ticket
     */
    public function setBarcode(Barcode $barcode): Ticket
    {
        $this->barcode = $barcode;
        return $this;
    }

    /**
     * @return Buyer|null
     */
    public function getBuyer(): ?Buyer
    {
        return $this->buyer;
    }

    /**
     * @param Buyer|null $buyer
     * @return Ticket
     */
    public function setBuyer(?Buyer $buyer): Ticket
    {
        $this->buyer = $buyer;
        return $this;
    }

    public function isBought(): bool
    {
        return $this->buyer !== null;
    }
}
