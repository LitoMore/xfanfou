<?php

namespace Util\Network;

/**
 * Curl wrapper class
 */
class Http
{
    /**
     * File name
     * @var string
     */
    private $file_name;

    /**
     * CURLFile object
     * @var CURLFile object
     */
    private $file;

    /**
     * timeout
     * @var int
     */
    private $timeout;

    public function __construct($timeout = 30)
    {
        $this->timeout = $timeout;
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * Makes an HTTP request of GET or POST
     * @param  string $method
     * @param  string $url
     * @param  array $data
     * @return Util\Network\Response
     */
    public function request($method, $url, $data = null)
    {
        $options = [
            CURLOPT_URL            => $url,
            CURLOPT_HEADER         => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => $this->timeout,
        ];

        $has_file = $this->file_name && $this->file;

        if ($method === 'get' || $has_file) {
            $options[CURLOPT_URL] = $this->buildUrl($url, $data);
        }

        if ($method === 'post') {
            $options[CURLOPT_POST] = 1;
        }

        if ($method === 'post' && !$has_file) {
            $options[CURLOPT_POSTFIELDS] = http_build_query($data);
        }

        // Add file to Post data
        if ($has_file) {
            $data[$this->file_name]      = $this->file;
            $options[CURLOPT_POSTFIELDS] = $data;
        }

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        if ($response === false) {
            $errmsg = curl_error($ch);
            $errno  = curl_errno($ch);
            curl_close($ch);
            throw new Exception($errmsg, $errno);
        }

        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headerSize  = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $info        = curl_getinfo($ch);

        // return string or false
        $body = substr($response, $headerSize);

        $response = new Response($body, $status_code, $info);

        curl_close($ch);

        return $response;
    }

    /**
     * Build an URL with an optional query string
     * @param  string $url
     * @param  array|string $args
     * @return string
     */
    public function buildUrl($url, $args = null)
    {
        if (!empty($args)) {
            $url .= (stripos($url, '?') !== false) ? '&' : '?';
            $url .= (is_string($args)) ? $args : http_build_query($args);
        }

        return $url;
    }

    /**
     * HTTP GET request
     * @param  string $url
     * @param  array|string $args
     * @return Util\Network\Response
     */
    public function get($url, array $args = null)
    {
        return $this->request('get', $url, $args);
    }

    /**
     * HTTP POST request
     * @param  string $url
     * @param  array  $data
     * @return Util\Network\Response
     */
    public function post($url, array $data = null)
    {
        return $this->request('post', $url, $data);
    }

    /**
     * Set upload file
     * @param string $file_name
     * @param Illuminate\Http\UploadedFile $file
     */
    public function setFile($file_name, $file)
    {
        $this->file_name = $file_name;
        $this->file      = new \CURLFile(
            $file->getPathname(),
            $file->getClientMimeType(),
            $file->getClientOriginalName()
        );
    }
}
