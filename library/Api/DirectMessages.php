<?php
namespace Library\Api;

use Util\Network\Api;

class DirectMessages extends Abstraction
{
    public static function destroy($params)
    {
        $response = Api::direct_messages()->destroy($params);

        return self::output($response);
    }

    public static function conversation($params)
    {
        $response = Api::direct_messages()->conversation($params);

        return self::output($response);
    }

    public static function news($params)
    {
        $response = Api::direct_messages()->news($params);

        return self::output($response);
    }

    public static function conversation_list($params)
    {
        $response = Api::direct_messages()->conversation_list($params);

        return self::output($response);
    }

    public static function inbox($params)
    {
        $response = Api::direct_messages()->inbox($params);

        return self::output($response);
    }

    public static function sent($params)
    {
        $response = Api::direct_messages()->sent($params);

        return self::output($response);
    }
}
