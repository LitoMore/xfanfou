<?php
namespace Library\Api;

use Util\Network\Api;

class Followers extends Abstraction
{
    public static function ids($params)
    {
        $response = Api::followers()->ids($params);

        return self::output($response);
    }
}
