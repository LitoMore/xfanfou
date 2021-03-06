<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Library\Api\Followers;

class FollowersController extends Abstraction
{
    public function getIds(Request $request)
    {
        $input = $request->all();
        $body = Followers::ids($input);

        return self::output($body);
    }
}
