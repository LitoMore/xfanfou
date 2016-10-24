<?php

namespace App\Http\Controllers\Home\M;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Library\Api;

class BaseController extends Controller
{
    protected $theme;
    protected $msg = null;

    public function __construct(Request $request)
    {

    }

    // 返回未读的 mentions, direct message 以及关注请求数量
    protected function getNotification()
    {
        $notification = Api\Account::notification([]);
        return $notification['content'];
    }

    // 返回当前用户的相关信息
    protected function getSelf()
    {
        $user = Api\Users::show([]);
        return $user['content'];
    }
}
