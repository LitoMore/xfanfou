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
    public $status_code;

    /**
     * The response info
     * @var array
     */
    public $info;

    /**
     * @param string $body
     * @param int $status_code
     * @param array  $info
     */
    public function __construct($body, $status_code, $info = [])
    {
        $this->body        = (string) $body;
        $this->status_code = $status_code;
        $this->info        = $info;
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
