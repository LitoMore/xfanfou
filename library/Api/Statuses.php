<?php
namespace Library\Api;

use Util\Network\Api;

class Statuses extends Abstraction
{
    public static function destroy($params = [])
    {
        $response = Api::statuses()->destroy($params);

        return self::output($response);
    }

    public static function homeTimeline($params = [])
    {
        $default = [
            'since_id' => 0,
            'max_id' => 0,
            'count' => 20,
        ];
        $params = array_merge($default, $params);
        $response = Api::statuses()->home_timeline($params);

        return self::output($response);
    }

    public static function publicTimeline($params = [])
    {
        $default = [
            'count' => 5,
            'since_id' => 0,
            'max_id' => 0
        ];
        $params = array_merge($default, $params);
        $response = Api::statuses()->public_timeline($params);

        return self::output($response);
    }

    public static function replies($params)
    {
        $default = [
            'since_id' => 0,
            'max_id' => 0,
            'count' => 20,
        ];
        $params = array_merge($default, $params);
        $response = Api::statuses()->replies($params);

        return self::output($response);
    }

    public static function followers($params)
    {
        $default = [
            'count' => 20,
        ];
        $params = array_merge($default, $params);
        $response = Api::statuses()->followers($params);

        return self::output($response);
    }

    public static function update($params)
    {
        $response = Api::statuses()->update($params);

        return self::output($response);
    }

    public static function user_timeline($params)
    {
        $default = [
            'since_id' => 0,
            'max_id' => 0,
            'count' => 0
        ];
        $params = array_merge($default);
        $response = Api::statuses()->user_timeline($params);

        return self::output($response);
    }

    public static function friends($params)
    {
        $response = Api::statuses()->friends($params);

        return self::output($response);
    }

    public static function context_timeline($params)
    {
        $response = Api::statuses()->context_timeline($params);

        return self::output($response);
    }

    public static function mentions($params)
    {
        $response = Api::statuses()->mentions($params);

        return self::output($response);
    }

    public static function show($params)
    {
        $response = Api::statuses()->show($params);

        return self::output($response);
    }
}
