<?php

declare(strict_types=1);

namespace AidynMakhataev\LaravelAttributes;

use Illuminate\Support\ServiceProvider;

final class LaravelAttributesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/attributes.php' => $this->app->configPath('attributes.php'),
            ], 'config');
        }

        $this->registerEventListeners();
        $this->registerCommandHandlers();
        $this->registerRoutes();
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/attributes.php', 'attributes');
    }

    private function registerEventListeners(): void
    {
        $isEnabled = (bool) config('attributes.events.enabled');

        if (false === $isEnabled) {
            return;
        }

        /** @var string[] $directories */
        $directories = config('attributes.events.directories');

        $registrar = new EventListenersAttributesRegistrar();

        $registrar->registerDirectories(
            directories: $directories
        );
    }

    private function registerCommandHandlers(): void
    {
        $isEnabled = (bool) config('attributes.command_bus.enabled');

        if (false === $isEnabled) {
            return;
        }

        /** @var string[] $directories */
        $directories = config('attributes.command_bus.directories');

        $registrar = new CommandHandlersAttributesRegistrar();

        $registrar->registerDirectories(
            directories: $directories
        );
    }

    public function registerRoutes(): void
    {
        $isEnabled = (bool) config('attributes.routing.enabled');

        if (false === $isEnabled) {
            return;
        }

        /** @var string[] $directories */
        $directories = config('attributes.routing.directories');

        $registrar = new RouteAttributesRegistrar(app()->router);

        $registrar->registerDirectories(
            directories: $directories
        );
    }
}