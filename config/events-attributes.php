<?php

return [
    /*
     * Automatic registration of listeners will only happen if this setting is `true`
     */
    'enabled'       => true,

    /*
     * Listeners in these directories that have attributes will automatically be registered.
     */
    'directories'   => [
        base_path('app/Listeners'),
    ],
];