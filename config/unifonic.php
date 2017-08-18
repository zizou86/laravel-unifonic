<?php

return [

    /*
    |--------------------------------------------------------------------------
    | UNIFONIC Apps Id
    |--------------------------------------------------------------------------
    |
    | Application key for unifonic API.
    |
     */
    'appsid' => [
        'default' => env('UNIFONIC_APPS_ID', ''),
        // OPTIONAL
        'second' => env('UNIFONIC_SECOND_APPS_ID', '')
    ],


    /*
    |--------------------------------------------------------------------------
    | Api URLS
    |--------------------------------------------------------------------------
    |
    | Urls for UNIFONIC Messages API
    |
     */
    'urls' => [
        'messages'  => 'http://api.unifonic.com/rest/Messages/',
        'account'  => 'http://api.unifonic.com/rest/Account/',
    ],

];