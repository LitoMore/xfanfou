<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Library\Api\Photos;

class PhotosController extends Abstraction
{
    public function getUserTimeline(Request $request)
    {
        $input = $request->all();
        $body = Photos::user_timeline($input);

        return self::output($body);
    }

    public function postUpload(Request $request)
    {
        $file = $request->file('photo');
        $params = $request->all();
        $body = Photos::upload($file, $params);

        return self::output($body);
    }
}
