<?php
namespace Library\Api;

use Util\Network\Api;

class Photos extends Abstraction
{
    public static function user_timeline($params)
    {
        $response = Api::photos()->user_timeline($params);

        return self::output($response);
    }

    public static function upload($file, $status)
    {
        $api = new Api;
        $api->file('photo', $file);
        $response = $api->photos()->upload($status);

        return self::output($response);
    }
}
