<?php

namespace AidynMakhataev\LaravelAttributes\Tests;

use AidynMakhataev\LaravelAttributes\EventListenersAttributesRegistrar;
use AidynMakhataev\LaravelAttributes\Tests\TestClasses\Events\DummyEvent;
use AidynMakhataev\LaravelAttributes\Tests\TestClasses\Listeners\DummyEventListener;
use Illuminate\Support\Facades\Event;

final class EventListenersAttributesRegistrarTest extends TestCase
{
    private EventListenersAttributesRegistrar $registrar;

    protected function setUp(): void
    {
        parent::setUp();

        $this->registrar = new EventListenersAttributesRegistrar();
    }


    public function testThatDirectoriesWasRegistered(): void
    {
        self::assertFalse(
            Event::hasListeners(DummyEvent::class)
        );

        $this->registrar->registerDirectories(
            directories: $this->getTestDirectories(),
        );

        self::assertTrue(
            Event::hasListeners(DummyEvent::class)
        );
    }

    public function testThatClassesWasRegistered(): void
    {
        self::assertFalse(
            Event::hasListeners(DummyEvent::class)
        );

        $this->registrar->registerClasses(
            classes: [DummyEventListener::class]
        );

        self::assertTrue(
            Event::hasListeners(DummyEvent::class)
        );
    }

    public function testThatClassWasRegistered(): void
    {
        self::assertFalse(
            Event::hasListeners(DummyEvent::class)
        );

        $this->registrar->registerClass(
            class: new \ReflectionClass(DummyEventListener::class)
        );

        self::assertTrue(
            Event::hasListeners(DummyEvent::class)
        );
    }

    protected function getTestDirectories(): array
    {
        return [
            __DIR__ . '/TestClasses/Listeners'
        ];
    }
}
