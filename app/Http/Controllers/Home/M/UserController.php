<?php

namespace App\Http\Controllers\Home\M;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Library\Api;

class UserController extends BaseController
{
    public function getUser($user_id, $page = 1)
    {
        $user = Api\Users::show([
            'id' => $user_id
        ]);
        $this->msg = \Session::get('msg');

        // 用户不存在返回404页面
        if ($user['code'] == 404) {
            return view('m.404');
        }

        // 其他类型错误
        if ($user['code'] != 0) {
            $this->msg = $user['error'];
        }

        $private = false;
        $timeline = [];
        if (!($user['content']->protected && !$user['content']->following)) {
            $timeline = Api\Statuses::user_timeline([
                'id' => $user_id,
                'count' => 15,
                'page' => $page,
                'format' => 'html'
            ])['content'];
        } else {
            $private = true;
        }

        // 存储每条消息需要@的人
        $stat = [];
        if (!$timeline) {
            foreach ($timeline as $status) {
                $stat[$status->id] = [
                    'text' => getStatusText($status->text),
                    'ats' => getAts('@' . $status->user->name . ' ' . $status->text),
                    'name' => $status->user->name
                ];
            }
        }
        \Session::set('stat', $stat);

        // 计算 timeline 的最大页数
        $maxPage = ceil($user['content']->statuses_count / 15);

        return view('m.user')->with([
            'user' => $user['content'],
            'timeline' => $timeline,
            'msg' => $this->msg,
            'page' => $page,
            'maxPage' => $maxPage,
            'private' => $private
        ]);
    }
}
