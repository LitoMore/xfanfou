<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Library\Api\Friends;

class FriendsController extends Abstraction
{
    public function getIds(Request $request)
    {
        $input = $request->all();
        $body = Friends::ids($input);

        return self::output($body);
    }
}
