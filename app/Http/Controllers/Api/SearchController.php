<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Util\Network\Api;

class SearchController extends Controller
{
    protected $q;

    public function __construct(Request $request)
    {
        $this->q = $request->input('q', '饭否');
    }

    public function getPublicTimeline(Request $request)
    {
        // Same with Api::get('search/public-timeline', $params);
        $result = Api::search()->publicTimeline(['q' => $this->q]);

        return response()->json(json_decode($result->body));
    }

    /**
     * 搜索用户
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function getUsers(Request $request)
    {
        // 此接口没有返回数据!
        $result = Api::search()->users(['q' => $this->q]);

        return response()->json(json_decode($result->body));
    }

    /**
     * 搜索用户 TL
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function getUserTimeline(Request $request)
    {
        $result = Api::search()->userTimeline(['q' => $this->q]);

        return response()->json(json_decode($result->body));
    }
}
