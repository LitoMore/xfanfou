<?php
namespace Library\Api;

use Util\Network\Api;

class Statuses
{
    public static function destroy($params = [])
    {
        $result = Api::statuses()->destroy($params);

        return json_decode($result->body);
    }

    public static function homeTimeline($params = [])
    {
        $default = [
            'since_id' => 0,
            'max_id' => 0,
            'count' => 20,
            'page' => 1
        ];
        $params = array_merge($default, $params);
        $result = Api::statuses()->home_timeline($params);

        return json_decode($result->body);
    }

    public static function publicTimeline($params = [])
    {
        $default = [
            'count' => 5,
            'since_id' => 0,
            'max_id' => 0
        ];
        $params = array_merge($default, $params);
        $result = Api::statuses()->public_timeline($params);

        return json_decode($result->body);
    }

    public static function replies($params)
    {
        $default = [
            'since_id' => 0,
            'max_id' => 0,
            'count' => 20,
            'page' => 1
        ];
        $params = array_merge($default, $params);
        $result = Api::statuses()->replies($params);

        return json_decode($result->body);
    }

    public static function followers($params)
    {
        $default = [
            'count' => 20,
            'page' => 1
        ];
        $params = array_merge($default, $params);
        $result = Api::statuses()->followers($params);

        return json_decode($result->body);
    }

    public static function update($params)
    {
        $result = Api::statuses()->update($params);

        return json_decode($result->body);
    }
}
