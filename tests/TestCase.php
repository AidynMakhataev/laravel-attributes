<?php

declare(strict_types=1);

namespace AidynMakhataev\LaravelAttributes\Tests;

use AidynMakhataev\LaravelAttributes\EventListenersAttributesRegistrar;
use Orchestra\Testbench\TestCase as Orchestra;
use AidynMakhataev\LaravelAttributes\LaravelAttributesServiceProvider;

abstract class TestCase extends Orchestra
{
    protected EventListenersAttributesRegistrar $registrar;

    protected function setUp(): void
    {
        parent::setUp();

        $this->registrar = new EventListenersAttributesRegistrar();
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
            LaravelAttributesServiceProvider::class,
        ];
    }
}