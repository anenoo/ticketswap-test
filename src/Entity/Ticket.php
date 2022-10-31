<?php

namespace TicketSwap\Assessment\Entity;

use TicketSwap\Assessment\Entity\Decorators\Barcode;
use TicketSwap\Assessment\Entity\Decorators\TicketId;

final class Ticket
{
    /**
     * @var TicketId
     */
    private TicketId $id;
    /**
     * @var array
     */
    private array $barcodes;
    /**
     * @var Buyer|null
     */
    private ?Buyer $buyer = null;

    /**
     * @param TicketId $id
     * @param array $barcodes
     * @param Buyer|null $buyer
     */
    public function __construct(
        TicketId $id,
        array    $barcodes,
        ?Buyer   $buyer = null
    ) {
        $this->setId($id)
            ->setBarcodes($barcodes)
            ->setBuyer($buyer);
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
     * @return array<Barcode>
     */
    public function getBarcodes(): array
    {
        return $this->barcodes;
    }

    /**
     * @param array<Barcode> $barcodes
     * @return Ticket
     */
    public function setBarcodes(array $barcodes): Ticket
    {
        $this->barcodes = $barcodes;
        return $this;
    }

    /**
     * @param Barcode $barcode
     * @return $this
     */
    public function addToBarcodes(Barcode $barcode): Ticket
    {
        $this->barcodes[] = $barcode;
        return $this;
    }

    /**
     * @param Barcode $barcode
     * @return $this
     */
    public function removeFromBarcodes(Barcode $barcode): Ticket
    {
        foreach ($this->barcodes as $barcodeKey => $existedBarcode) {
            if ((string)$barcode === (string)$existedBarcode) {
                unset($this->barcodes[$barcodeKey]);
            }
        }
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

    /**
     * @return bool
     */
    public function isBought(): bool
    {
        return $this->buyer !== null;
    }
}
