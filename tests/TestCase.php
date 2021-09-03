<?php

declare(strict_types=1);

namespace AidynMakhataev\LaravelAttributes\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use AidynMakhataev\LaravelAttributes\LaravelAttributesServiceProvider;

abstract class TestCase extends Orchestra
{

    protected function getPackageProviders($app): array
    {
        return [
            LaravelAttributesServiceProvider::class,
        ];
    }
}