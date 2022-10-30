<?php

namespace TicketSwap\Assessment\Entity;

/**
 *
 */
final class Marketplace
{
    /**
     * @var array
     */
    private array $listingsForSale;

    /**
     * @param array<Listing> $listingsForSale
     */
    public function __construct(array $listingsForSale = [])
    {
        $this->setListingsForSale($listingsForSale);
    }

    /**
     * @return array<Listing>
     */
    public function getListingsForSale(): array
    {
        return $this->listingsForSale;
    }

    /**
     * @param array<Listing> $listingsForSale
     * @return Marketplace
     */
    public function setListingsForSale(array $listingsForSale): Marketplace
    {
        $this->listingsForSale = $listingsForSale;
        return $this;
    }

    /**
     * @return $this
     */
    public function emptyListingForSales(): Marketplace
    {
        $this->listingsForSale = [];
        return $this;
    }

    /**
     * @param Listing $listingsForSale
     * @return $this
     */
    public function addToListForSale(Listing $listingsForSale): Marketplace
    {
        $this->listingsForSale[] = $listingsForSale;
        return $this;
    }

    /**
     * @param $key
     * @return $this
     */
    public function removeFromListForSale($key): Marketplace
    {
        unset($this->listingsForSale[$key]);
        return $this;
    }

}
