<?php
namespace Library\Api;

use Util\Network\Response;

class Abstraction
{
    protected static function output(Response $response)
    {
        if ($response->status_code === 200) {
            return [
                'code' => 0,
                'content' => json_decode($response->body)
            ];
        }

        return [
            'code' => $response->status_code,
            'error' => json_decode($response->body)->error
        ];
    }
}
