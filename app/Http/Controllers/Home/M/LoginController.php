<?php

namespace App\Http\Controllers\Home\M;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Util\Network\Api;

class LoginController extends BaseController
{
    public function getLogin()
    {


        return view('m.login')->with([
            'title' => '登陆'
        ]);
    }

    public function postLogin(Request $request)
    {

    }
}
