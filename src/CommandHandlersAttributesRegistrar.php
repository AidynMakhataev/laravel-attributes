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
        $attributes = $class->getAttributes(CommandHandler::class);

        if (count($attributes) === 0) {
            return;
        }

        /** @var CommandHandler $attribute */
        $attribute = $attributes[0]->newInstance();

        Bus::map([
            $attribute->command => $class->getName(),
        ]);
    }
}