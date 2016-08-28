<?php
namespace Library\Api;

use Util\Network\Api;

class Favorites extends Abstraction
{
    public static function destroy($params)
    {
        $response = Api::favorites()->destroy($params);

        return self::output($response);
    }

    public static function id($params)
    {
        $response = Api::favorites()->id($params);

        return self::output($response);
    }

    public static function create($params)
    {
        $response = Api::favorites()->create($params);

        return self::output($response);
    }
}
