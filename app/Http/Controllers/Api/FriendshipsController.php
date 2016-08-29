<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Library\Api\Friendships;

class FriendshipsController extends Abstraction
{
    public function postCreate(Request $request)
    {
        $input = $request->all();
        $body = Friendships::create($input);

        return self::output($body);
    }

    public function postDestroy(Request $request)
    {
        $input = $request->all();
        $body = Friendships::destroy($input);

        return self::output($body);
    }

    public function getRequests(Request $request)
    {
        $input = $request->all();
        $body = Friendships::requests($input);

        return self::output($body);
    }

    public function postDeny(Request $request)
    {
        $input = $request->all();
        $body = Friendships::deny($input);

        return self::output($body);
    }

    public function getExists(Request $request)
    {
        $input = $request->all();
        $body = Friendships::exists($input);

        return self::output($body);
    }

    public function postAccept(Request $request)
    {
        $input = $request->all();
        $body = Friendships::accept($input);

        return self::output($body);
    }

    public function getShow(Request $request)
    {
        $input = $request->all();
        $body = Friendships::show($input);

        return self::output($body);
    }
}
