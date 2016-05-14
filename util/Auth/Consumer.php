<?php

namespace Util\Auth;

/**
 * Consumer
 */
class Consumer
{
    protected $consumer_key;

    protected $consumer_secret;

    public function __construct($consumer_key, $consumer_secret)
    {
        $this->consumer_key    = $consumer_key;
        $this->consumer_secret = $consumer_secret;
    }

    public function getConsumerKey()
    {
        return $this->consumer_key;
    }

    public function getConsumerSecret()
    {
        return $this->consumer_secret;
    }
}
