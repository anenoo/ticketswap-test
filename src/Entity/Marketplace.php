<?php

namespace TicketSwap\Assessment\Entity;

/**
 * The place, sellers add there tickets.
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
        $this->emptyListingForSales();
        foreach ($listingsForSale as $listing) {
            $this->addToListForSale($listing);
        }
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
        if ($listingsForSale->isApproveByAdmin()) {
            $this->listingsForSale[] = $listingsForSale;
        }
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
