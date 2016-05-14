<?php

namespace Util\Auth;

interface Contract
{
    public function make(Token $token, Consumer $consumer);
    public function encodeParams($base_url, $method, array $params = null);
}
