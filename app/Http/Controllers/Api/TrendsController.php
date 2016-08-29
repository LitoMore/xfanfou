<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Library\Api\Trends;

class TrendsController extends Abstraction
{
    public function getList(Request $request)
    {
        $input = $request->all();
        $body = Trends::lists($input);

        return self::output($body);
    }
}
