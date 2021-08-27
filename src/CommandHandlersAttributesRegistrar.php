<?php

declare(strict_types=1);

namespace AidynMakhataev\LaravelAttributes;

use AidynMakhataev\LaravelAttributes\Attributes\CommandHandler;
use Illuminate\Support\Facades\Bus;
use ReflectionClass;

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
            $type = $parameters[0]->getType();

            $command = $type->getName();

            Bus::map([
                $command => $class->getName(),
            ]);
        }
    }
}