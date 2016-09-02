<?php
namespace Library\Api;

use Util\Network\Api;

class Favorites extends Abstraction
{
    public static function destroy($msg_id, $params)
    {
        $api = new Api;
        $response = $api->post('http://api.fanfou.com/favorites/destroy/' . $msg_id . '.json', $params);
    }

    public static function id($params)
    {
        $response = Api::favorites()->id($params);

        return self::output($response);
    }

    public static function create($msg_id, $params)
    {
        $api = new Api;
        $response = $api->post('http://api.fanfou.com/favorites/create/' . $msg_id . '.json', $params);

        return self::output($response);
    }
}
