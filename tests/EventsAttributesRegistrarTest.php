<?php

namespace AidynMakhataev\EventsAttributes\Tests;

use AidynMakhataev\EventsAttributes\Tests\TestClasses\Events\DummyEvent;
use AidynMakhataev\EventsAttributes\Tests\TestClasses\Listeners\DummyEventListener;
use Illuminate\Support\Facades\Event;

final class EventsAttributesRegistrarTest extends TestCase
{
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
}
