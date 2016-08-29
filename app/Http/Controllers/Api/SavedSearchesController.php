<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Library\Api\SavedSearches;

class SavedSearchesController extends Abstraction
{
    public function postCreate(Request $request)
    {
        $input = $request->all();
        $body = SavedSearches::create($input);

        return self::output($body);
    }

    public function postDestroy(Request $request)
    {
        $input = $request->all();
        $body = SavedSearches::destroy($input);

        return self::output($body);
    }

    public function getShow(Request $request)
    {
        $input = $request->all();
        $body = SavedSearches::show($input);

        return self::output($body);
    }

    public function getList(Request $request)
    {
        $input = $request->all();
        $body = SavedSearches::lists($input);

        return self::output($body);
    }
}
