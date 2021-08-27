<?php

declare(strict_types=1);

namespace AidynMakhataev\LaravelAttributes\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
final class CommandHandler
{
    public string $command;

    /**
     * @param class-string $command
     */
    public function __construct(string $command)
    {
        $this->command = $command;
    }
}