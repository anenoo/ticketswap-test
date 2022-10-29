<?php

namespace TicketSwap\Assessment\Entity\Decorators;

use Stringable;

final class ListingId implements Stringable
{
    public function __construct(private string $id)
    {
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
