<?php

declare(strict_types=1);

namespace AidynMakhataev\LaravelAttributes\Tests;

use AidynMakhataev\LaravelAttributes\CommandHandlersAttributesRegistrar;
use AidynMakhataev\LaravelAttributes\Tests\TestClasses\CommandHandlers\CreateOrderCommand;
use AidynMakhataev\LaravelAttributes\Tests\TestClasses\CommandHandlers\CreateOrderHandler;
use Illuminate\Support\Facades\Bus;

final class CommandHandlersAttributesRegistrarTest extends TestCase
{
    private CommandHandlersAttributesRegistrar $registrar;
    private CreateOrderCommand $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->registrar = new CommandHandlersAttributesRegistrar();
        $this->command = new CreateOrderCommand();
    }

    public function testThatDirectoriesWasRegistered(): void
    {
        self::assertFalse(
            Bus::hasCommandHandler($this->command)
        );

        $this->registrar->registerDirectories(
            directories: $this->getTestDirectories(),
        );

        self::assertTrue(
            Bus::hasCommandHandler($this->command)
        );
    }

    public function testThatClassesWasRegistered(): void
    {
        self::assertFalse(
            Bus::hasCommandHandler($this->command)
        );

        $this->registrar->registerClasses(
            classes: [CreateOrderHandler::class],
        );

        self::assertTrue(
            Bus::hasCommandHandler($this->command)
        );
    }

    public function testThatClassWasRegistered(): void
    {
        self::assertFalse(
            Bus::hasCommandHandler($this->command)
        );

        $this->registrar->registerClass(
            class: new \ReflectionClass(CreateOrderHandler::class),
        );

        self::assertTrue(
            Bus::hasCommandHandler($this->command)
        );
    }

    protected function getTestDirectories(): array
    {
        return [
            __DIR__ . '/TestClasses/CommandHandlers'
        ];
    }
}