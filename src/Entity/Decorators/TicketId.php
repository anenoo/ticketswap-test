<?php

namespace TicketSwap\Assessment\Entity\Decorators;

use Stringable;

final class TicketId implements Stringable
{
    public function __construct(private string $id)
    {
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public function equals(TicketId $otherId): bool
    {
        return $this->id === $otherId->id;
    }
}
