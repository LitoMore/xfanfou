<?php
namespace Library\Api;

use Util\Network\Api;

class Search
{
    public static function publicTimeline($qurey = [])
    {
        $result = Api::search()->publicTimeline($qurey);

        return json_decode($result->body);
    }

    public static function users($query = [])
    {
        $result = Api::search()->users($query);

        return json_decode($result->body);
    }

    public static function user_timeline($query = [])
    {
        $result = Api::search()->user_timeline($query);

        return json_decode($result->body);
    }
}
