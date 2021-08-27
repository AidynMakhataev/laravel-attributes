<?php

declare(strict_types=1);

namespace AidynMakhataev\LaravelAttributes;

use Composer\Autoload\ClassMapGenerator;
use ReflectionClass;

abstract class AbstractAttributesRegistrar implements AttributesRegistrarInterface
{
    /**
     * @param string[] $directories
     */
    public function registerDirectories(array $directories): void
    {
        foreach ($directories as $directory) {
            if (false === file_exists($directory)) {
                continue;
            }

            /** @var string[] $classes */
            $classes = array_keys(
                ClassMapGenerator::createMap($directory)
            );

            $this->registerClasses(
                classes: $classes
            );
        }
    }

    /**
     * @param string[] $classes
     */
    public function registerClasses(array $classes): void
    {
        foreach ($classes as $class) {
            if (false === class_exists($class)) {
                continue;
            }

            $reflectionClass = new ReflectionClass($class);

            $this->registerClass($reflectionClass);
        }
    }
}