<?php

declare(strict_types=1);

namespace AidynMakhataev\LaravelAttributes\Tests\TestClasses\CommandHandlers;

use AidynMakhataev\LaravelAttributes\Attributes\CommandHandler;

final class CreateOrderHandler
{
    #[CommandHandler]
    public function handle(CreateOrderCommand $command): void
    {

    }
}