<?php
namespace Library\Api;

use Util\Network\Api;

class Users extends Abstraction
{
    public static function tagged($params)
    {
        $response = Api::users()->tagged($params);

        return self::output($response);
    }

    public static function show($params)
    {
        $response = Api::users()->show($params);

        return self::output($response);
    }

    public static function tag_list($params)
    {
        $response = Api::users()->tag_list($params);

        return self::output($response);
    }

    public static function followers($params)
    {
        $response = Api::users()->followers($params);

        return self::output($response);
    }

    public static function recommendation($params)
    {
        $response = Api::users()->recommendation($params);

        return self::output($response);
    }

    public static function cancel_recommendation($params)
    {
        $response = Api::users()->recommendation($params);

        return self::output($response);
    }

    public static function friends($params)
    {
        $response = Api::users()->friends($params);

        return self::output($params);
    }
}
