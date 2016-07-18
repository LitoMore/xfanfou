<?php

namespace App\Http\Controllers\Api;

use Log;

class Exception extends \Exception
{
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        Log::warning($message);
        parent::__construct($message, $code, $previous);
    }
}
