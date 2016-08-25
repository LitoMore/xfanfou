<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Library\Api;

class MController extends BaseController
{
    public function home(Request $request)
    {
        if ($request->isMethod('get')) {
            $home_timeline = Api\Statuses::homeTimeline([
                'count' => 15,
                'format' => 'html'
            ]);
            return view('m.home')->with([
                'homeTimeline' => $home_timeline
            ]);
        }

        if ($request->isMethod('post')) {
            // TODO
        }
    }
}
