<?php
namespace Library\Api;

use Util\Network\Api;

class Blocks extends Abstraction
{
    public static function ids($params)
    {
        $response = Api::blocks()->ids($params);

        return self::output($response);
    }

    public static function blocking($params)
    {
        $response = Api::blocks()->blocking($params);

        return self::output($response);
    }

    public static function create($params)
    {
        $response = Api::blocks()->create($params);

        return self::output($response);
    }

    public static function exists($params)
    {
        $response = Api::blocks()->exists($params);

        return self::output($response);
    }

    public static function destroy($params)
    {
        $response = Api::blocks()->exists($params);

        return self::output($response);
    }
}