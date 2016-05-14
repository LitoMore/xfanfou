<?php

namespace Util\Auth;

/**
 * Token
 */
class Token
{
    /**
     * @var string
     */
    protected $request_token;

    /**
     * @var string
     */
    protected $request_token_secret;

    /**
     * @var string
     */
    protected $access_token;

    /**
     * @var string
     */
    protected $access_token_secret;

    /**
     * @var string
     */
    protected $token_name = 'fanfou.token';

    /**
     * Retrieve Token
     * @return Util\Auth\Token
     */
    public function retrieveToken()
    {
        if (($token = session($this->token_name)) !== null) {
            return unserialize($token);
        }

        return $this;
    }

    /**
     * Store Token
     * @return void
     */
    public function storeToken()
    {
        return session()->put($this->token_name, serialize($this));
    }

    /**
     * @return string
     */
    public function getAccessTokenSecret()
    {
        return $this->access_token_secret;
    }

    /**
     * @param string $access_token_secret
     */
    public function setAccessTokenSecret($access_token_secret)
    {
        $this->access_token_secret = $access_token_secret;
    }

    /**
     * @return string
     */
    public function getRequestTokenSecret()
    {
        return $this->request_token_secret;
    }

    /**
     * @param string $request_token_secret
     */
    public function setRequestTokenSecret($request_token_secret)
    {
        $this->request_token_secret = $request_token_secret;
    }

    /**
     * @return string
     */
    public function getRequestToken()
    {
        return $this->request_token;
    }

    /**
     * @param string $request_token
     */
    public function setRequestToken($request_token)
    {
        $this->request_token = $request_token;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * @return string $access_token
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }
}
