<?php
namespace Library\Api;

use Util\Network\Api;

class Trends extends Abstraction
{
    public static function lists($params)
    {
        $response = Api::trends()->list($params);

        return self::output($response);
    }
}
