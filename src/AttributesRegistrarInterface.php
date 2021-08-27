<?php

declare(strict_types=1);

namespace AidynMakhataev\LaravelAttributes;

use ReflectionClass;

interface AttributesRegistrarInterface
{
    /**
     * @param string[] $directories
     */
    public function registerDirectories(array $directories): void;

    /**
     * @param string[] $classes
     */
    public function registerClasses(array $classes): void;

    public function registerClass(ReflectionClass $class): void;
}