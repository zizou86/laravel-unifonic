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
    'appsids' => [
        'default' => env('UNIFONIC_APPS_ID', '')
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
    ],

];