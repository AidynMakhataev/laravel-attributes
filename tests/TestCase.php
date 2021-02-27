<?php

declare(strict_types=1);

namespace AidynMakhataev\EventsAttributes\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use AidynMakhataev\EventsAttributes\EventsAttributesServiceProvider;

final class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            EventsAttributesServiceProvider::class,
        ];
    }
}