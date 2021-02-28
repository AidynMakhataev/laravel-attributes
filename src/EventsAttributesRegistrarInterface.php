<?php

declare(strict_types=1);

namespace AidynMakhataev\EventsAttributes;

interface EventsAttributesRegistrarInterface
{
    /**
     * @param string[] $directories
     */
    public function registerDirectories(array $directories): void;

    /**
     * @param string[] $classes
     */
    public function registerClasses(array $classes): void;
}