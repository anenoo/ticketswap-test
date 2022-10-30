<?php

namespace TicketSwap\Assessment\Entity\Decorators;

use Stringable;

/**
 *
 */
final class TicketId implements Stringable
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
     * @param TicketId $otherId
     * @return bool
     */
    public function equals(TicketId $otherId): bool
    {
        return $this->id === $otherId->id;
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
     * @return TicketId
     */
    public function setId(string $id): TicketId
    {
        $this->id = $id;
        return $this;
    }
}
