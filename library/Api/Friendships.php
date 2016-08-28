<?php
namespace Library\Api;

use Util\Network\Api;

class Friendships extends Abstraction
{
    public static function create($params)
    {
        $response = Api::friendships()->create($params);

        return self::output($response);
    }

    public static function destroy($params)
    {
        $response = Api::friendships()->destroy($params);

        return self::output($response);
    }

    public static function requests($params)
    {
        $response = Api::friendships()->requests($params);

        return self::output($response);
    }

    public static function deny($params)
    {
        $response = Api::friendships()->deny($params);

        return self::output($response);
    }

    public static function exists($params)
    {
        $response = Api::friendships()->exists($params);

        return self::output($response);
    }

    public static function accept($params)
    {
        $response = Api::friendships()->accept($params);

        return self::output($response);
    }

    public static function show($params)
    {
        $response = Api::friendships()->show($params);

        return self::output($response);
    }
}
