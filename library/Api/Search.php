<?php
namespace Library\Api;

use Util\Network\Api;

class Search extends Abstraction
{
    public static function publicTimeline($qurey = [])
    {
        $response = Api::search()->publicTimeline($qurey);

        return self::output($response);
    }

    public static function users($query = [])
    {
        $response = Api::search()->users($query);

        return self::output($response);
    }

    public static function user_timeline($query = [])
    {
        $response = Api::search()->user_timeline($query);

        return self::output($response);
    }
}
