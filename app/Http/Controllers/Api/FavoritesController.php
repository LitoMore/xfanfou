<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Library\Api\Favorites;

class FavoritesController extends Abstraction
{
    public function postDestroy(Request $request)
    {
        $input = $request->all();
        $body = Favorites::destroy($input);

        return self::output($body);
    }

    public function getId(Request $request)
    {
        $input = $request->all();
        $body = Favorites::id($input);

        return self::output($body);
    }

    public function postCreate(Request $request)
    {
        $input = $request->all();
        $body = Favorites::create($input);

        return self::output($body);
    }
}
