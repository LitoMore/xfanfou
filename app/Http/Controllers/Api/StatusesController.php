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

        return response()->json($body);
    }

    public function getHomeTimeline(Request $request)
    {
        $input = $request->all();
        $body = Statuses::homeTimeline($input);

        return response()->json($body);
    }

    public function getPublicTimeline(Request $request)
    {
        $input = $request->all();
        $body = Statuses::publicTimeline($input);

        return response()->json($body);
    }

    public function getReplies(Request $request)
    {
        $input = $request->all();
        $body = Statuses::replies($input);

        return response()->json($body);
    }

    public function getFollowers(Request $request)
    {
        $input = $request->all();
        $body = Statuses::followers($input);

        return response()->json($body);
    }

    public function postUpdate(Request $request)
    {
        $input = $request->all();
        $body = Statuses::update($input);

        return response()->json($body);
    }

    public function getFriends(Request $request)
    {
        $input = $request->all();
        $body = Statuses::friends($input);

        return response()->json($body);
    }

    public function getContextTimeline(Request $request)
    {
        $input = $request->all();
        $body = Statuses::context_timeline($input);

        return response()->json($body);
    }

    public function getMentions(Request $request)
    {
        $input = $request->all();
        $body = Statuses::mentions($input);

        return response()->json($body);
    }

    public function getShow(Request $request)
    {
        $input = $request->all();
        $body = Statuses::show($input);

        return response()->json($body);
    }
}
