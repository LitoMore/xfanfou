<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Library\Api\Blocks;

class BlocksController extends Abstraction
{
    public function getIds(Request $request)
    {
        $input = $request->all();
        $body = Blocks::ids($input);

        return self::output($body);
    }

    public function getBlocking(Request $request)
    {
        $input = $request->all();
        $body = Blocks::blocking($input);

        return self::output($body);
    }

    public function postCreate(Request $request)
    {
        $input = $request->all();
        $body = Blocks::create($input);

        return self::output($body);
    }

    public function getExists(Request $request)
    {
        $input = $request->all();
        $body = Blocks::exists($input);

        return self::output($body);
    }

    public function postDestroy(Request $request)
    {
        $input = $request->all();
        $body = Blocks::destroy($input);

        return self::output($body);
    }
}
