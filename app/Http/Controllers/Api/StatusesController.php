<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Library\Api\Statuses;

class StatusesController extends Abstraction
{
    public function postDestroy(Request $request)
    {
        $input = $request->only(['id']);
        $body = Statuses::destroy($input);

        return self::output($body);
    }

    public function getHomeTimeline(Request $request)
    {
        $input = $request->all();
        $body = Statuses::homeTimeline($input);

        return self::output($body);
    }

    public function getPublicTimeline(Request $request)
    {
        $input = $request->all();
        $body = Statuses::publicTimeline($input);

        return self::output($body);
    }

    public function getReplies(Request $request)
    {
        $input = $request->all();
        $body = Statuses::replies($input);

        return self::output($body);
    }

    public function getFollowers(Request $request)
    {
        $input = $request->all();
        $body = Statuses::followers($input);

        return self::output($body);
    }

    public function postUpdate(Request $request)
    {
        $input = $request->all();
        $body = Statuses::update($input);

        return self::output($body);
    }

    public function getUserTimeline(Request $request)
    {
        $input = $request->all();
        $body = Statuses::user_timeline($input);

        return self::output($body);
    }

    public function getFriends(Request $request)
    {
        $input = $request->all();
        $body = Statuses::friends($input);

        return self::output($body);
    }

    public function getContextTimeline(Request $request)
    {
        $input = $request->all();
        $body = Statuses::context_timeline($input);

        return self::output($body);
    }

    public function getMentions(Request $request)
    {
        $input = $request->all();
        $body = Statuses::mentions($input);

        return self::output($body);
    }

    public function getShow(Request $request)
    {
        $input = $request->all();
        $body = Statuses::show($input);

        return self::output($body);
    }
}
