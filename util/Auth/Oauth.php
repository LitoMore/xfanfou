<?php

namespace Util\Auth;

use Util\Network\Exception;

class Oauth extends AuthAbstract implements Contract
{
    /**
     * Prepare params
     * @param  array|null $params
     * @return array|null
     */
    protected function prepareParams(array $params = null)
    {
        if ($this->token_secret === null) {
            $this->token_secret = '';
        }

        return $params;
    }
}
