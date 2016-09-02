<?php

namespace App\Http\Controllers\Home\M;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Library\Api;

class HomeController extends BaseController
{
    public function getHome()
    {
        $home_timeline = Api\Statuses::homeTimeline([
            'count' => 15
        ]);
        $this->msg = \Session::get('msg');

        if ($home_timeline['code'] != 0) {
            $this->msg = $home_timeline['error'];
        }

        return view('m.home')->with([
            'title' => '首页',
            'homeTimeline' => $home_timeline['content'],
            'msg' => $this->msg
        ]);
    }

    public function postHome(Request $request)
    {
        $update = Api\Statuses::update($request->all());

        $this->msg = '发送成功';

        if ($update['code'] != 0) {
            $this->msg = $update['error'];
        }

        // 是一条转发或回复消息则存一条flash
        if ($request->has('in_reply_to_status_id') || $request->has('repost_status_id')) {
            \Session::flash('replied', true);
        }

        \Session::flash('msg', $this->msg);

        return back();
    }
}
