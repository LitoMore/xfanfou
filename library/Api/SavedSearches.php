<?php
namespace Library\Api;

use Util\Network\Api;

class SavedSearches extends Abstraction
{
    public static function create($params)
    {
        $response = Api::savaed_searches()->create($params);

        return self::output($response);
    }

    public static function destroy($params)
    {
        $response = Api::saved_searches()->destroy($params);

        return self::output($response);
    }

    public static function show($params)
    {
        $response = Api::saved_searches()->show($params);

        return self::output($response);
    }

    public static function lists($params)
    {
        $response = Api::saved_searches()->list($params);

        return self::output($response);
    }
}
