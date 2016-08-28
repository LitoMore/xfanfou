<?php
namespace Library\Api;

use Util\Network\Api;

class Friends extends Abstraction
{
    public static function ids($params)
    {
        $response = Api::friends()->ids($params);

        return self::output($response);
    }
}
