<?php

namespace Util\Auth;

use Util\Network\Exception;

abstract class AuthAbstract implements Contract
{
    protected $token;
    protected $token_secret;
    protected $consumer_key;
    protected $consumer_secret;

    public function make(Token $token, Consumer $consumer)
    {
        $this->token           = $token->getAccessToken();
        $this->token_secret    = $token->getAccessTokenSecret();
        $this->consumer_key    = $consumer->getConsumerKey();
        $this->consumer_secret = $consumer->getConsumerSecret();

        if ($this->consumer_secret === null) {
            throw new Exception('You must supply strings for consumer_secret.');
        }

        return $this;
    }

    /**
     * Encode params
     * @param  string     $base_url
     * @param  string     $method
     * @param  array|null $params
     * @return array
     */
    public function encodeParams($base_url, $method, array $params = null)
    {
        $params = $this->prepareParams($params);

        if ($this->token) {
            $params['oauth_token'] = $this->token;
        }

        $params['oauth_consumer_key']     = $this->consumer_key;
        $params['oauth_timestamp']        = time();
        $params['oauth_nonce']            = md5(microtime(true) . uniqid('', true));
        $params['oauth_signature_method'] = 'HMAC-SHA1';
        $params['oauth_version']          = '1.0';

        if (isset($params['oauth_signature'])) {
            unset($params['oauth_signature']);
        }

        uksort($params, 'strcmp');

        $query_string = http_build_query($params, '', '&', PHP_QUERY_RFC3986);

        $base = [
            strtoupper($method),
            $base_url,
            $query_string,
        ];
        $base        = $this->safeEncode($base);
        $base_string = implode('&', $base);

        $key = rawurlencode($this->consumer_secret) . '&' . rawurlencode($this->token_secret);

        $params['oauth_signature'] = base64_encode(hash_hmac('sha1', $base_string, $key, true));

        return $params;
    }


    /**
     * Encode a string according to RFC 3986.
     * @param  array|string $data
     * @return string
     */
    protected function safeEncode($data)
    {
        if (is_array($data)) {
            return array_map([$this, 'safeEncode'], $data);
        }

        if (is_scalar($data)) {
            return str_ireplace(
                ['+', '%7E'],
                [' ', '~'],
                rawurlencode($data)
            );
        }

        return '';
    }

    /**
     * Prepare params
     * @param  array|null $params
     * @return array|null
     */
    abstract protected function prepareParams(array $params = null);
}
