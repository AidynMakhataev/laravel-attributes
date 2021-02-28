<?php

declare(strict_types=1);

namespace AidynMakhataev\EventsAttributes;

use AidynMakhataev\EventsAttributes\Attributes\RegisterListener;
use Composer\Autoload\ClassMapGenerator;
use Illuminate\Support\Facades\Event;
use ReflectionClass;

final class EventsAttributesRegistrar
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

    /**
     * @param ReflectionClass $class
     * @psalm-suppress UndefinedMethod
     */
    private function registerClass(ReflectionClass $class): void
    {
        foreach ($class->getMethods() as $method) {
            $attributes = $method->getAttributes(RegisterListener::class);

            $parameters = $method->getParameters();

            if ($attributes && $parameters) {
                $type = $parameters[0]->getType();

                /** @var string $eventClass */
                $eventClass = $type?->getName();

                Event::listen(
                    $eventClass,
                    \sprintf("%s@%s", $method->class, $method->name)
                );
            }
        }
    }
}