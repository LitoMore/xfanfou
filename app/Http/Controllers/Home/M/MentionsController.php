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
            'count' => 15,
            'format' => 'html'
        ]);
        $msgStatus = null;

        if ($mentions['code'] != 0) {
            $msgStatus = $mentions['error'];
        }

        return view('m.mentions')->with([
            'mentions' => $mentions['content'],
            'msgStatus' => $msgStatus
        ]);
    }
}
