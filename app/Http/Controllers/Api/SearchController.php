<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Library\Api\Search;

class SearchController extends Abstraction
{
    protected $q;

    public function __construct(Request $request)
    {
        $this->q = $request->input('q', '饭否');
    }

    public function getPublicTimeline(Request $request)
    {
        $body = Search::publicTimeline(['q' => $this->q]);

        return self::output($body);
    }

    /**
     * 搜索用户
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function getUsers(Request $request)
    {
        // 此接口没有返回数据!
        $body = Search::users(['q' => $this->q]);

        return self::output($body);
    }

    /**
     * 搜索用户 TL
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function getUserTimeline(Request $request)
    {
        $body = Search::user_timeline(['q' => $this->q]);

        return self::output($body);
    }
}
