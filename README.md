# Laravel Attributes

This package provides php attributes automatically register Laravel routes, event listeners and command bus handlers. 


## Requirements

- PHP ^8.0
- Laravel ^8.0

## Installation

You can install the package via composer:

```bash
composer require aidynmakhataev/laravel-attributes
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="AidynMakhataev\LaravelAttributes\LaravelAttributesServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
    'events' => [
        /*
         * Automatic registration of listeners will only happen if this setting is `true`
         */
        'enabled'       => true,

        /*
         * Listeners in these directories that have attributes will automatically be registered.
         */
        'directories'   => [
            base_path('app/Listeners')
        ]
    ],

    'command_bus' => [
        /*
         * Automatic registration of command handlers will only happen if this setting is `true`
         */
        'enabled'       => true,

        /*
         * Handlers in these directories that have attributes will automatically be registered.
         */
        'directories'   => [
            base_path('app/CommandHandlers')
        ],
    ],

    'routing' => [
        /*
         * Automatic registration of routes will only happen if this setting is `true`
         */
        'enabled'       => true,

        /*
         * Controllers in these directories that have attributes will automatically be registered.
         */
        'directories'   => [
            base_path('app/Http/Controllers')
        ],
    ],
];
```

# Usage

The package provides several annotations that should be put on your methods.

## Event Listeners

```php

namespace App\Listeners;

use AidynMakhataev\LaravelAttributes\Attributes\EventListener;
use App\Events\OrderShipped;

class SendShipmentNotification
{
    #[EventListener]
    public function handle(OrderShipped $event)
    {
        //
    }
}
```

This attribute will automatically register this listener by executing following command:

```php
Event::listen(OrderShipped::class, 'SendShipmentNotification@handle');
```

## Command Handlers

```php

namespace App\CommandHandlers;

use AidynMakhataev\LaravelAttributes\Attributes\CommandHandler;
use App\Events\OrderShipped;

class CreateOrderCommandHandler
{
    #[CommandHandler]
    public function handle(CreateOrderCommand $command)
    {
        //
    }
}
```

This attribute will automatically register this handler by executing following command:

```php
Bus::map([
    CreateOrderCommand::class => CreateOrderCommandHandler::class,
]);
```

## Routing

```php

namespace App\Http\Controllers;

use AidynMakhataev\LaravelAttributes\Attributes\Route;
use App\Events\OrderShipped;
use Illuminate\Http\Request;

class OrderController
{
    #[Route(path: '/orders', methods: ['POST'], name: 'orders.store', middlewares: ['auth'])]
    public function store(Request $request)
    {
        //
    }
}
```

This attribute will automatically register this route by executing following command:

```php
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store')->middlewares(['auth']);
```

## Testing

``` bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
