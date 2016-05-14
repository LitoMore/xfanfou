<?php

return [
    /*
    |--------------------------------------------------------------------------
    | FanFou Config
    |--------------------------------------------------------------------------
    |
    | http://fanfou.com/apps
    |
    | wiki:
    | https://github.com/FanfouAPI/FanFouAPIDoc/wiki
    |
     */

    'request_token_url' => 'http://fanfou.com/oauth/request_token',

    'access_token_url'  => 'http://fanfou.com/oauth/access_token',

    'authorize_url'     => 'http://fanfou.com/oauth/authorize',

    'consumer_key'      => env('CONSUMER_KEY', 'bb518c25f531f21871276486d13fcde5'),

    'consumer_secret'   => env('CONSUMER_SECRET', 'b18c21febcb266b0b49894608761a7ba'),

    'api_url'           => env('API_URL', 'http://api.fanfou.com'),

    'auth_mode'         => env('AUTH_MODE', 'oauth'),

];
