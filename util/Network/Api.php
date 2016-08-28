<?php

namespace Util\Network;

use Session;
use Util\Auth\Consumer;
use Util\Auth\Contract as AuthResolver;
use Util\Auth\Token;

class Api
{
    /**
     * List of fanfou method names that require the use of POST
     * @page https://github.com/FanfouAPI/FanFouAPIDoc/wiki/Apicategory
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
    protected $domain;

    /**
     * Response format
     * @var string
     */
    protected $format = 'json';

    /**
     * Uri parts
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
     * @var Util\Auth\Token
     */
    protected $token;

    /**
     * @var Util\Auth\Consumer
     */
    protected $consumer;

    /**
     * Auth resolver
     * @var Util\Auth\Contract
     */
    protected static $resolver;

    /**
     * Fanfou config
     * @var array
     */
    protected $config;

    /**
     * Curl handle
     * @var Http
     */
    protected $http;

    public function __construct()
    {
        $this->http     = new Http;
        $this->config   = $config   = config('fanfou');
        $this->domain   = $config['api_url'];
        $this->token    = (new Token())->retrieveToken();
        $this->consumer = new Consumer($config['consumer_key'], $config['consumer_secret']);
    }

    /**
     * Set Auth resolver
     * @param AuthResolver $resolver
     */
    public static function setAuthResolver(AuthResolver $resolver)
    {
        static::$resolver = $resolver;
    }

    /**
     * return the request method of uri
     * @param  string $uri
     * @return string
     */
    protected function methodForUri($uri)
    {
        if (in_array($uri, self::POST_ACTIONS)) {
            return 'post';
        }

        return 'get';
    }

    /**
     * Handle an OAuth request
     * @param  string     $base_url
     * @param  string     $method
     * @param  array|null $params
     * @return Util\Network\Response
     */
    protected function fetch($base_url, $method, array $params = [])
    {
        $auth    = static::$resolver->make($this->token, $this->consumer);
        $timeout = array_pull($params, 'timeout', $this->timeout);
        $params  = $auth->encodeParams($base_url, $method, $params);

        $this->http->setTimeout($timeout);
        $this->response = $this->http->{strtolower($method)}($base_url, $params);

        if ($this->response->status_code === 200) {
            return $this->response;
        }

        return $this->response;
    }

    /**
     * Get request
     * @param  string     $base_url
     * @param  array|null $params
     * @return Util\Network\Response
     */
    protected function get($base_url, array $params = null)
    {
        return $this->fetch($base_url, 'get', $params);
    }

    /**
     * Post request
     * @param  string     $base_url
     * @param  array|null $params
     * @return Util\Network\Response
     */
    protected function post($base_url, array $params = null)
    {
        return $this->fetch($base_url, 'post', $params);
    }

    /**
     * Assign file data
     * @param  string $name  file name
     * @param  $_FILE $value
     * @return Util\Network\Api
     */
    protected function file($name, $value)
    {
        $this->http->setFile($name, $value);
        return $this;
    }

    /**
     * Request token request
     * @return Util\Auth\Token
     */
    protected function requestToken()
    {
        $this->token->setAccessTokenSecret('');
        $this->fetch($this->config['request_token_url'], 'get');
        $this->parseTokenResponse($this->response);

        return $this->token;
    }

    /**
     * Access token request
     * @param array|null $params
     * @return Util\Auth\Token
     */
    protected function accessToken(array $params = [])
    {
        if ($this->config['auth_mode'] === 'xauth') {
            $this->token->setAccessTokenSecret(null);
            $this->token->setAccessToken(null);
        }
        $this->fetch($this->config['access_token_url'], 'get', $params);
        $this->parseTokenResponse($this->response);

        return $this->token;
    }

    /**
     * Get authorize url
     * @param  string $request_token
     * @param  string $callback_url
     * @return string
     */
    protected function getAuthorizationUri($request_token, $callback_url = '')
    {
        $authorize_url = $this->config['authorize_url'];

        return $this->http->buildUrl($authorize_url, [
            'oauth_token'    => $request_token,
            'oauth_callback' => $callback_url,
        ]);
    }

    /**
     * Parse token response
     * @param  Response $response
     * @return void
     */
    public function parseTokenResponse($response)
    {
        if ($response->status_code !== 200) {
            try {
                // 饭否输出的 xml 格式有误, 没有对 & 进行编码
                $xml = simplexml_load_string(str_replace('&', '&amp;', $response->body));
            } catch (Exception $e) {
                throw new Exception('Failed To Parse XML');
            }

            $error = isset($xml->error) ? (string) $xml->error : 'Error Processing Request';

            throw new Exception($error);
        }

        parse_str($response, $data);
        if (null === $data || !is_array($data)) {
            throw new Exception('Unable to parse response.');
        }

        $this->token->setRequestToken($data['oauth_token']);
        $this->token->setAccessToken($data['oauth_token']);
        $this->token->setRequestTokenSecret($data['oauth_token_secret']);
        $this->token->setAccessTokenSecret($data['oauth_token_secret']);
        $this->token->storeToken();
    }

    /**
     * Method chaining
     * Use Api::statuses()->homeTimeline() get your home timeline
     * api.fanfou.com/statuses/home_timeline
     * @param  string $key
     * @param  array $args
     * @return mixed
     */
    public function __call($key, $args)
    {
        $func = snake_case($key);

        if ($func === 'getAuthorizationUri') {
            return $this->getAuthorizationUri($key, $args);
        }

        if (in_array($func, ['get', 'post', 'file', 'request_token', 'access_token'])) {
            return call_user_func_array([$this, camel_case($func)], $args);
        }

        $this->uri[] = $func;
        if (count($this->uri) === 1) {
            return $this;
        }

        $uri    = implode('/', $this->uri);
        $params = (isset($args[0]) && is_array($args[0])) ? $args[0] : [];

        // 自定义请求方法, 否则根据路径获取
        $method = array_pull($params, 'method', $this->methodForUri($uri));

        $base_url = sprintf('%s/%s.%s', $this->domain, $uri, $this->format);

        return $this->fetch($base_url, $method, $params);
    }

    public static function __callStatic($method, $args)
    {
        $instance = new static;

        return call_user_func_array([$instance, $method], $args);
    }
}
