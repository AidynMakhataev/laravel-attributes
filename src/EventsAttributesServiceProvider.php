<?php

declare(strict_types=1);

namespace AidynMakhataev\EventsAttributes;

use Illuminate\Support\ServiceProvider;

final class EventsAttributesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/events-attributes.php' => $this->app->configPath('events-attributes.php'),
            ], 'config');
        }

        if ($this->isEnabled()) {
            $this->registerEventListeners();
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/events-attributes.php', 'events-attributes');
    }

    private function registerEventListeners(): void
    {
        $registrar = new EventsAttributesRegistrar();

        $registrar->registerDirectories(
            directories: $this->getDirectories()
        );
    }

    /**
     * @return string[]
     */
    private function getDirectories(): array
    {
        /** @var string[] $directories */
        $directories = config('events-attributes.directories');

        return $directories;
    }

    private function isEnabled(): bool
    {
        return (bool) config('events-attributes.enabled');
    }
}