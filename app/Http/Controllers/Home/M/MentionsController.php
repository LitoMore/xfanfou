<?php

namespace App\Http\Controllers\Home\M;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Library\Api;

class MentionsController extends BaseController
{
    public function mentions($page = 1)
    {
        $mentions = Api\Statuses::mentions([
            'count' => 15,
            'page' => $page,
            'format' => 'html'
        ]);
        $this->msg = \Session::get('msg');

        if ($mentions['code'] != 0) {
            $this->msg = $mentions['error'];
        }

        // 存储每条消息需要@的人
        $stat = [];
        foreach ($mentions['content'] as $status) {
            $stat[$status->id] = [
                'text' => getStatusText($status->text),
                'ats' => getAts('@' . $status->user->name . ' ' . $status->text),
                'name' => $status->user->name
            ];
        }
        \Session::set('stat', $stat);

        return view('m.mentions')->with([
            'mentions' => $mentions['content'],
            'msg' => $this->msg,
            'page' => $page
        ]);
    }
}
