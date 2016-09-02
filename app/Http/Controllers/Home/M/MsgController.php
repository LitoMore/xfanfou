<?php

namespace App\Http\Controllers\Home\M;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Library\Api;

class MsgController extends BaseController
{
    public function reply($msg_id, Request $request)
    {
        // 如果是从回复或转发页面过来的，则转到首页
        $replied = \Session::get('replied');
        if ($replied) {
            return redirect()->intended(route('M.getHome'));
        }

        $show = Api\Statuses::show(['id' => $msg_id]);
        $this->msg = \Session::get('msg');

        if ($show['code'] != 0) {
            $this->msg = $show['error'];
        }

        return view('m.msg_reply')->with([
            'status' => $show['content'],
            'msg_id' => $msg_id,
            'msg' => $this->msg
        ]);
    }

    public function forward($msg_id, Request $request)
    {
        // 如果是从回复或转发页面过来的，则转到首页
        $replied = \Session::get('replied');
        if ($replied) {
            return redirect()->intended(route('M.getHome'));
        }

        $show = Api\Statuses::show(['id' => $msg_id]);
        $this->msg = \Session::get('msg');

        if ($show['code'] != 0) {
            $this->msg = $show['error'];
        }

        return view('m.msg_forward')->with([
            'status' => $show['content'],
            'msg_id' => $msg_id,
            'msg' => $this->msg
        ]);
    }

    public function del($msg_id)
    {
        $destroy = Api\Statuses::destroy(['id' => $msg_id]);

        $this->msg = '删除成功';

        if ($destroy['code'] != 0) {
            $this->msg = $destroy['error'];
        }

        \Session::flash('msg', $this->msg);

        return back();
    }

    public function favoriteAdd($msg_id)
    {
        $create = Api\Favorites::create($msg_id, []);

        $this->msg = '收藏成功';

        if ($create['code'] != 0) {
            $this->msg = $create['error'];
        }

        \Session::flash('msg', $this->msg);

        return back();
    }

    public function favoriteDel($msg_id)
    {
        $destroy = Api\Favorites::destroy($msg_id, []);

        $this->msg = '取消收藏成功';

        if ($destroy['code'] != 0) {
            $this->msg = $destroy['error'];
        }

        \Session::flash('msg', $this->msg);

        return back();
    }
}
