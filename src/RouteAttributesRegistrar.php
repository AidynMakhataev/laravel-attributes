<?php

declare(strict_types=1);

namespace AidynMakhataev\LaravelAttributes;

use AidynMakhataev\LaravelAttributes\Attributes\Route;
use Illuminate\Routing\Router;
use ReflectionClass;

final class RouteAttributesRegistrar extends AbstractAttributesRegistrar
{
    public function __construct(private Router $router)
    {
    }

    public function registerClass(ReflectionClass $class): void
    {
        foreach ($class->getMethods() as $method) {
            $attributes = $method->getAttributes(Route::class);

            if (count($attributes) === 0) {
                continue;
            }

            $attributeClass = $attributes[0]->newInstance();

            $action = $method->getName() === '__invoke' ? $class->getName() : [$class->getName(), $method->getName()];

            $route = $this->router
                ->addRoute($attributeClass->methods, $attributeClass->path, $action);

            if ($attributeClass->name) {
                $route->name($attributeClass->name);
            }

            if ($attributeClass->middlewares) {
                $route->middleware($attributeClass->middlewares);
            }
        }
    }
}