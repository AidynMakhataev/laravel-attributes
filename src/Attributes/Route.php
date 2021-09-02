<?php

declare(strict_types=1);

namespace AidynMakhataev\LaravelAttributes\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
final class Route
{
    public function __construct(
        public string $path,
        public array $methods,
        public ?string $name = null,
        public array $middlewares = [],
    )
    {
    }
}