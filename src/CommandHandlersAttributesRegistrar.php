<?php

declare(strict_types=1);

namespace AidynMakhataev\LaravelAttributes;

use AidynMakhataev\LaravelAttributes\Attributes\CommandHandler;
use Illuminate\Support\Facades\Bus;
use ReflectionClass;
use ReflectionNamedType;

final class CommandHandlersAttributesRegistrar extends AbstractAttributesRegistrar
{
    public function registerClass(ReflectionClass $class): void
    {
        if (false === $class->hasMethod('handle')) {
            return;
        }

        $method = $class->getMethod('handle');

        $attributes = $method->getAttributes(CommandHandler::class);
        $parameters = $method->getParameters();


        if ($parameters && $attributes) {
            /** @var ReflectionNamedType|null $type */
            $type = $parameters[0]->getType();

            /** @var string $command */
            $command = $type?->getName();

            Bus::map([
                $command => $class->getName(),
            ]);
        }
    }
}