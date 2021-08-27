# Laravel Events Attributes

This package provides ```#[RegisterListener]``` attribute to automatically register event listeners in Laravel. Here's a quick example:

```php

namespace App\Listeners;

use AidynMakhataev\EventsAttributes\Attributes\EventListener;
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

## Requirements

- PHP ^8.0
- Laravel ^8.0

## Installation

You can install the package via composer:

```bash
composer require aidynmakhataev/laravel-events-attributes
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="AidynMakhataev\EventsAttributes\EventsAttributesServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
    /*
     *  Automatic registration of listeners will only happen if this setting is `true`
     */
    'enabled' => true,

    /*
     * Listeners in these directories that have attributes will automatically be registered.
     */
    'directories' => [
        base_path('app/Listeners'),
    ],
];
```

## Testing

``` bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
