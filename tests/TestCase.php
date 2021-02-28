<?php

declare(strict_types=1);

namespace AidynMakhataev\EventsAttributes\Tests;

use AidynMakhataev\EventsAttributes\EventsAttributesRegistrar;
use Orchestra\Testbench\TestCase as Orchestra;
use AidynMakhataev\EventsAttributes\EventsAttributesServiceProvider;

abstract class TestCase extends Orchestra
{
    protected EventsAttributesRegistrar $registrar;

    protected function setUp(): void
    {
        parent::setUp();

        $this->registrar = new EventsAttributesRegistrar();
    }

    protected function getTestDirectories(): array
    {
        return [
            __DIR__ . '/TestClasses/Listeners'
        ];
    }

    protected function getPackageProviders($app): array
    {
        return [
            EventsAttributesServiceProvider::class,
        ];
    }
}