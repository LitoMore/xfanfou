<?php

namespace App\Http\Controllers\Home\M;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Library\Api;

class MentionsController extends BaseController
{
    public function mentions()
    {
        $mentions = Api\Statuses::mentions([
            'count' => 15
        ]);
        $this->msg = \Session::get('msg');

        if ($mentions['code'] != 0) {
            $this->msg = $mentions['error'];
        }

        return view('m.mentions')->with([
            'mentions' => $mentions['content'],
            'msg' => $this->msg
        ]);
    }
}
