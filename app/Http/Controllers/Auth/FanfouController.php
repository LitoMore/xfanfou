<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Util\Network\Api;
use Validator;

class FanfouController extends Controller
{
    protected $auth_mode;

    public function __construct()
    {
        $this->auth_mode = config('fanfou.auth_mode');
    }

    /**
     * 授权页面
     * @param  Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        if ($this->auth_mode === 'xauth') {
            return view('f7ios.login');
        }

        $token = Api::requestToken();
        $authorize_url   = Api::getAuthorizationUri(
            $token->getRequestToken(),
            url()->action('Auth\FanfouController@callback')
        );

        return redirect($authorize_url);
    }

    /**
     * XAuth 表单提交
     * @param  Request $request
     * @return Util\Network\Response
     */
    public function login(Request $request)
    {
        // 用户名为邮箱或者手机号码
        if (strpos($request->input('username'), '@') !== false) {
            $username = 'required|email';
        } else {
            $username = ['required', 'regex:/^(13[0-9]|14[57]|15[012356789]|17[0678]|18[0-9])[0-9]{8}$/'];
        }
        $password = 'required|string';

        $this->validate($request, compact('username', 'password'));

        Api::accessToken($request->only(['username', 'password']));

        return $this->loginSuccess();
    }

    /**
     * 授权返回页面
     * @param  Request  $request
     * @return Util\Network\Response
     */
    public function callback(Request $request)
    {
        if ($this->auth_mode === 'xauth') {
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'oauth_token' => 'required|alpha_num|size:32',
        ]);

        if ($validator->fails()) {
            return redirect()->action('Auth\FanfouController@index');
        }

        Api::accessToken();

        return $this->loginSuccess();
    }

    /**
     * 授权成功处理
     * @return mixed
     */
    protected function loginSuccess()
    {
        // 返回授权前页面
        $url = session('previous_url');
        if ($url) {
            session()->forget('previous_url');
            return redirect($url);
        }

        return Api::account()->verifyCredentials();
    }
}
