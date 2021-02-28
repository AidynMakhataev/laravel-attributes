<?php

declare(strict_types=1);

namespace AidynMakhataev\EventsAttributes\Attributes;

use Attribute;

#[Attribute]
final class Listen
{
    /** @psalm-var class-string  */
    public string $event;

    /**
     * @param string $event
     * @psalm-param class-string $event
     */
    public function __construct(string $event)
    {
        $this->event = $event;
    }
}