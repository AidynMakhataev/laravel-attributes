<?php

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