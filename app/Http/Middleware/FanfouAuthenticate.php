<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Util\Auth\Token;

class FanfouAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $token = (new Token())->retrieveToken();

        if ($token->getAccessToken() !== null &&
            $token->getAccessTokenSecret() !== null) {
            return $next($request);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response('Unauthorized.', 401);
        }

        if ($request->method() === 'GET') {
            session()->put('previous_url', $request->url());
        }

        return redirect()->action('Auth\FanfouController@index');
    }
}
