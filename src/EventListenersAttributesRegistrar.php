<?php

declare(strict_types=1);

namespace AidynMakhataev\LaravelAttributes;

use AidynMakhataev\LaravelAttributes\Attributes\EventListener;
use Illuminate\Support\Facades\Event;
use ReflectionClass;

final class EventListenersAttributesRegistrar extends AbstractAttributesRegistrar
{
    /**
     * @param ReflectionClass $class
     * @psalm-suppress UndefinedMethod
     */
    public function registerClass(ReflectionClass $class): void
    {
        foreach ($class->getMethods() as $method) {
            $attributes = $method->getAttributes(EventListener::class);

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