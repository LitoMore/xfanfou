<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests;

class IndexController extends BaseController
{
    // index page
    public function getIndex(Request $request)
    {
        return view('welcome');
    }

    // home page
    public function getHome(Request $request)
    {
        return view('f7ios.home');
    }

    // public page
    public function getPublic(Request $request)
    {
        return view('f7ios.public');
    }

    // mentions page
    public function getMentions(Request $request)
    {
        return view('f7ios.mentions');
    }

    // login page
    public function getLogin(Request $request)
    {
        return view('f7ios.login');
    }
}
