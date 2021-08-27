<?php

declare(strict_types=1);

namespace AidynMakhataev\LaravelAttributes\Tests\TestClasses\Listeners;

use AidynMakhataev\LaravelAttributes\Attributes\EventListener;
use AidynMakhataev\LaravelAttributes\Tests\TestClasses\Events\DummyEvent;

final class DummyEventListener
{
    #[EventListener]
    public function handle(DummyEvent $event): void
    {

    }

    #[EventListener]
    public function test(DummyEvent $event): void
    {

    }
}