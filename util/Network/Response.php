<?php

namespace Util\Network;

/**
 * Response class
 */
class Response
{
    /**
     * The response body
     * @var string
     */
    public $body;

    /**
     * The response code
     * @var int
     */
    public $statusCode;

    /**
     * The response info
     * @var array
     */
    public $info;

    /**
     * @param string $body
     * @param int $statusCode
     * @param array  $info
     */
    public function __construct($body, $statusCode, $info = [])
    {
        $this->body       = (string) $body;
        $this->statusCode = $statusCode;
        $this->info       = $info;
    }

    /**
     * Return the response body
     * @return string
     */
    public function __toString()
    {
        return $this->body;
    }
}
