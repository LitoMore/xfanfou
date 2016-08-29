<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Library\Api\Users;

class UsersController extends Abstraction
{
    public function getTagged(Request $request)
    {
        $input = $request->all();
        $body = Users::tagged($input);

        return self::output($body);
    }

    public function getShow(Request $request)
    {
        $input = $request->all();
        $body = Users::show($input);

        return self::output($body);
    }

    public function getTagList(Request $request)
    {
        $input = $request->all();
        $body = Users::tag_list($input);

        return self::output($body);
    }

    public function getFollowers(Request $request)
    {
        $input = $request->all();
        $body = Users::followers($input);

        return self::output($body);
    }

    public function getRecommendation(Request $request)
    {
        $input = $request->all();
        $body = Users::recommendation($input);

        return self::output($body);
    }

    public function postCancelRecommendation(Request $request)
    {
        $input = $request->all();
        $body = Users::cancel_recommendation($input);

        return self::output($body);
    }

    public function getFriends(Request $request)
    {
        $input = $request->all();
        $body = Users::friends($input);

        return self::output($body);
    }
}
