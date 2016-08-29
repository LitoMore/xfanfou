<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Library\Api\Account;

class AccountController extends Abstraction
{
    public function getVerifyCredentials(Request $request)
    {
        $input = $request->all();
        $body = Account::verify_credentials($input);


    }

    public function postVerifyCredentials(Request $request)
    {
        $input = $request->all();
        $body = Account::verify_credentials($input);

        return self::output($body);
    }

    public function postUpdateProfileImage(Request $request)
    {
        $file = $request->file('image');
        $params = $request->all();
        $body = Account::update_profile_image($file, $params);

        return self::output($body);
    }

    public function getRateLimitStatus(Request $request)
    {
        $input = $request->all();
        $body = Account::rate_limit_status($input);

        return self::output($body);
    }

    public function postUpdateProfile(Request $request)
    {
        $input = $request->all();
        $body = Account::update_profile($input);

        return self::output($body);
    }

    public function getNotification(Request $request)
    {
        $input = $request->all();
        $body = Account::notification($input);

        return self::output($body);
    }

    public function postUpdateNotifyNum(Request $request)
    {
        $input = $request->all();
        $body = Account::update_notify_num($input);

        return self::output($body);
    }

    public function getNotifyNum(Request $request)
    {
        $input = $request->all();
        $body = Account::notify_num($input);

        return self::output($body);
    }
}
