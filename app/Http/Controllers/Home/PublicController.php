<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests;

class PublicController extends BaseController
{
    public function index(Request $request)
    {
        return view('f7ios.public');
    }
}
