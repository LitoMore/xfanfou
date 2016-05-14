<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Util\Network\Api;

class PhotosController extends Controller
{
    public function getUserTimeline(Request $request)
    {

    }

    public function postUpload(Request $request)
    {
        $status = $request->input('status', 'test' . time());

        $api = new Api;
        $api->file('photo', $request->file('photo'));
        $result = $api->photos()->upload(compact('status'));

        return response()->json(json_decode($result->body));
    }
}
