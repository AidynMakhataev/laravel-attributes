<?php

declare(strict_types=1);

namespace AidynMakhataev\LaravelAttributes\Tests;

use AidynMakhataev\LaravelAttributes\RouteAttributesRegistrar;
use AidynMakhataev\LaravelAttributes\Tests\TestClasses\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

final class RouteAttributesRegistrarTest extends TestCase
{
    private RouteAttributesRegistrar $registrar;

    protected function setUp(): void
    {
        parent::setUp();

        $this->registrar = new RouteAttributesRegistrar($this->app->get('router'));
    }

    public function testThatDirectoriesWasRegistered(): void
    {
        self::assertEmpty(
            Route::getRoutes()->getRoutes()
        );

        $this->registrar->registerDirectories(
            directories: $this->getTestDirectories()
        );


        self::assertNotEmpty(
            Route::getRoutes()->getRoutes()
        );
    }

    public function testThatClassesWasRegistered(): void
    {
        self::assertEmpty(
            Route::getRoutes()->getRoutes()
        );

        $this->registrar->registerClasses([OrderController::class]);

        self::assertNotEmpty(
            Route::getRoutes()->getRoutes()
        );
    }

    public function testThatClassWasRegistered(): void
    {
        $action = sprintf('%s@store',OrderController::class);

        self::assertNull(
            Route::getRoutes()->getByAction($action)
        );

        $this->registrar->registerClass(new \ReflectionClass(OrderController::class));

        self::assertNotNull(
            Route::getRoutes()->getByAction($action)
        );
    }

    protected function getTestDirectories(): array
    {
        return [
            __DIR__ . '/TestClasses/Controllers'
        ];
    }

}