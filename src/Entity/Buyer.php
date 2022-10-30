<?php

namespace TicketSwap\Assessment\Entity;

use Stringable;

/**
 *
 */
final class Buyer implements Stringable
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->setName($name);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Buyer
     */
    public function setName(string $name): Buyer
    {
        $this->name = $name;
        return $this;
    }


}
