<?php

namespace TicketSwap\Assessment\Entity\Decorators;

use Stringable;

/**
 *
 */
final class ListingId implements Stringable
{
    private string $id;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->setId($id);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return ListingId
     */
    public function setId(string $id): ListingId
    {
        $this->id = $id;
        return $this;
    }
}
