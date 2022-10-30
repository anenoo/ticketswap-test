<?php

namespace TicketSwap\Assessment\Entity\Decorators;

use Stringable;

/**
 * A converted text for use in tickets.
 */
final class Barcode implements Stringable
{
    /**
     * @var string
     */
    private string $type;
    /**
     * @var string
     */
    private string $value;

    /**
     * @param string $type
     * @param string $value
     */
    public function __construct(string $type, string $value)
    {
        $this->setType($type);
        $this->setValue($value);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('%s:%s', $this->type, $this->value);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Barcode
     */
    public function setType(string $type): Barcode
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return Barcode
     */
    public function setValue(string $value): Barcode
    {
        $this->value = $value;
        return $this;
    }
}
