<?php
namespace Library\Api;

use Util\Network\Api;

class Account extends Abstraction
{
    public static function verify_credentials($params)
    {
        $response = Api::account()->verify_credentials($params);

        return self::output($response);
    }

    public static function update_profile_image($file, $params)
    {
        $api = new Api;
        $api->file('image', $file);
        $response = $api->photos()->upload($params);

        return self::output($response);
    }

    public static function rate_limit_status($params)
    {
        $response = Api::account()->rate_limit_status($params);

        return self::output($response);
    }

    public static function update_profile($params)
    {
        $response = Api::account()->update_profile($params);

        return self::output($response);
    }

    public static function notification($params)
    {
        $response = Api::account()->notification($params);

        return self::output($response);
    }

    public static function update_notify_num($params)
    {
        $response = Api::account()->update_notify_num($params);

        return self::output($response);
    }

    public static function notify_num($params)
    {
        $response = Api::account()->notify_num($params);

        return self::output($response);
    }
}
