<?php

declare(strict_types=1);

namespace AidynMakhataev\LaravelAttributes\Tests\TestClasses\Controllers;

use AidynMakhataev\LaravelAttributes\Attributes\Route;

final class OrderController
{
    public const ROUTE_NAME = 'orders';

    #[Route(path: '/orders', methods: ['POST'], name: self::ROUTE_NAME)]
    public function store(): void
    {

    }
}