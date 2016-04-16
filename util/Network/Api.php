<?php

namespace Util\Network;

use Session;
use Util\Auth\Oauth;

class Api
{
    /**
     * List of fanfou method names that require the use of POST
     */
    const POST_ACTIONS = [
        // blocks
        'blocks/create',

        // users
        'users/cancel_recommendation',

        // account
        'account/update_profile_image', 'account/update_profile',
        'account/update_notify_num',

        // saved-searches
        'saved_searches/create', 'saved_searches/destroy',

        // photos
        'photos/upload',

        // favorites
        'favorites/destroy', 'favorites/create',

        // friendships
        'friendships/create', 'friendships/destroy', 'friendships/deny',
        'friendships/accept',

        // statuses
        'statuses/destroy', 'statuses/update',

        // direct-messages
        'direct_messages/destroy', 'direct_messages/new',
    ];

    /**
     * Api domain
     * @var string
     */
    protected $domain = 'http://api.fanfou.com';

    protected $format = 'json';

    /**
     * uri parts
     * @var array
     */
    protected $uri = [];

    /**
     * Request timeout
     * @var integer
     */
    protected $timeout = 30;

    /**
     * Response
     * @var object
     */
    public $response;

    /**
     * Token
     * @var string|null
     */
    protected $token;

    /**
     * Secret
     * @var string|null
     */
    protected $secret;

    /**
     * return the request method of uri
     * @param  string $uri
     * @return string
     */
    public function methodForUri($uri)
    {
        $postStr = implode('|', self::POST_ACTIONS);
        if (strpos($postStr, $uri) !== false) {
            return 'post';
        }

        return 'get';
    }

    public function __construct()
    {
        list($token, $secret) = $this->retrieveToken();
        $this->token          = $token;
        $this->secret         = $secret;
    }

    /**
     * Retrieve Token
     * @return array
     */
    public function retrieveToken()
    {
        return [session('token'), session('secret')];
    }

    /**
     * Store Token
     * @return void
     */
    public function storeToken()
    {
        session()->put('token', $this->token);
        session()->put('secret', $this->secret);
    }

    /**
     * Get Token
     * @return array
     */
    public function getToken()
    {
        return [$this->token, $this->secret];
    }

    /**
     * Set Token
     * @param string $token
     * @param string $secret
     */
    public function setToken($token, $secret)
    {
        $this->token  = $token;
        $this->secret = $secret;
    }

    /**
     * 链式调用, 例如使用 (new Api)->statuses->homeTimeline()
     * 访问 api.fanfou.com/statuses/home_timeline
     * @param  string $key  路径
     * @param  array $args
     * @return mixed
     */
    public function __call($key, $args)
    {
        $method = snake_case($key);

        if (in_array($method, ['request_token', 'access_token'])) {
            return $this->{camel_case($method)};
        }

        $this->uri[] = $method;
        if (count($this->uri) === 1) {
            return $this;
        }

        $uri    = implode('/', $this->uri);
        $params = (isset($args[0]) && is_array($args[0])) ? $args[0] : [];
        $method = array_pull($params, 'method', $this->methodForUri($uri));

        $base_url = sprintf('http://%s/%s.%s', $this->domain, $uri, $this->format);

        $this->http($base_url, $method, $params);

        return $this;
    }

    /**
     * Handle an OAuth request
     * @param  string     $base_url
     * @param  string     $method
     * @param  array|null $params
     * @return Response
     */
    public function http($base_url, $method, array $params = null)
    {
        $auth   = new Oauth($this->token, $this->secret, env('CONSUMER_KEY'), env('CONSUMER_SECRET'));
        $params = $auth->encodeParams($base_url, $method, $params);

        return $this->response = (new Http)->{strtolower($method)}($base_url, $params);
    }

    /**
     * Request token request
     * @return mixed
     */
    public function requestToken()
    {
        $base_url = 'http://fanfou.com/oauth/request_token';
        $this->setToken('', '');

        $this->http($base_url, 'get');
        $this->parseTokenResponse($this->response);

        return $this;
    }

    /**
     * Access token request
     * @return mixed
     */
    public function accessToken()
    {
        $base_url = 'http://fanfou.com/oauth/access_token';

        $this->http($base_url, 'get');
        $this->parseTokenResponse($this->response);

        return $this;
    }

    /**
     * Parse token response
     * @param  Response $response
     * @return void
     */
    public function parseTokenResponse($response)
    {
        if ($response->status_code !== 200) {
            // 需要解析 XML…
            throw new Exception('Error Processing Request');
        }

        parse_str($response, $data);
        if (null === $data || !is_array($data)) {
            throw new Exception('Unable to parse response.');
        }

        $this->setToken($data['oauth_token'], $data['oauth_token_secret']);
        $this->storeToken();
    }

    public function __get($key)
    {
        $this->uri[] = snake_case($key);
        return $this;
    }

    public function __toString()
    {
        if ($this->response !== null) {
            return $this->response->body;
        }

        return null;
    }
}
