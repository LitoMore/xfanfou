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
            'count' => 15,
            'format' => 'html'
        ]);
        return view('m.home')->with([
            'homeTimeline' => $home_timeline['content']
        ]);
    }

    public function postHome(Request $request)
    {
        $home_timeline = Api\Statuses::homeTimeline([
            'count' => 15,
            'format' => 'html'
        ]);
        $msgStatus = '发送成功';
        $input = $request->all();
        $update = Api\Statuses::update($input);

        if ($update['code'] != 0) {
            $msgStatus = $update['error'];
        }

        return view('m.home')->with([
            'homeTimeline' => $home_timeline['content'],
            'msgStatus' => $msgStatus
        ]);
    }
}
