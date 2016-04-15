<?php

namespace Util\Network;

/**
 * Curl wrapper class
 */
class Http
{
    /**
     * Curl handle
     * @var resource
     */
    protected $ch;

    /**
     * Makes an HTTP request of GET or POST
     * @param  string $method
     * @param  string $url
     * @param  array $data
     * @return Response
     */
    public function request($method, $url, $data = null)
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_HEADER, true);

        if ($method === 'post') {
            curl_setopt($this->ch, CURLOPT_POST, 1);
        }

        if (!empty($data)) {
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        $response = curl_exec($this->ch);
        if ($response === false) {
            $errmsg = curl_error($this->ch);
            $errno  = curl_errno($this->ch);
            curl_close($this->ch);
            throw new Exception($errmsg, $errno);
        }

        $statusCode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
        $info       = curl_getinfo($this->ch);

        // return string or false
        $body = substr($response, $headerSize);

        $response = new Response($body, $statusCode, $info);

        curl_close($this->ch);

        return $response;
    }

    /**
     * HTTP GET request
     * @param  string $url
     * @param  array|string $args
     * @return Response
     */
    public function get($url, $args = null)
    {
        if (!empty($args)) {
            $url .= (stripos($url, '?') !== false) ? '&' : '?';
            $url .= (is_string($args)) ? $args : http_build_query($args);
        }

        return $this->request('get', $url);
    }

    /**
     * HTTP POST request
     * @param  string $url
     * @param  array  $data
     * @return Response
     */
    public function post($url, array $data = [])
    {
        return $this->request('post', $url, $data);
    }

}
