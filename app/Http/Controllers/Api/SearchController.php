<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Util\Network\Api;

class SearchController extends Controller
{
    public function getPublicTimeline(Request $request)
    {
        // TODO Api::get('search/public-timeline', $params);
    }

    public function getUsers(Request $request)
    {

    }

    public function getUserTimeline(Request $request)
    {

    }
}
