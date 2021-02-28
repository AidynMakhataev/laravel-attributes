<?php

declare(strict_types=1);

namespace AidynMakhataev\EventsAttributes\Tests\TestClasses\Listeners;

use AidynMakhataev\EventsAttributes\Attributes\RegisterListener;
use AidynMakhataev\EventsAttributes\Tests\TestClasses\Events\DummyEvent;

final class DummyEventListener
{
    #[RegisterListener]
    public function handle(DummyEvent $event): void
    {

    }

    #[RegisterListener]
    public function test(DummyEvent $event): void
    {

    }
}