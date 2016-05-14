<?php

namespace Util\Auth;

use Util\Network\Exception;

class Xauth extends AuthAbstract implements Contract
{
    /**
     * Prepare params
     * @param  array|null $params
     * @return array|null
     */
    protected function prepareParams(array $params = null)
    {
        if ($this->token_secret === null) {
            if (!isset($params['username']) || !isset($params['password'])) {
                throw new Exception('You must supply strings for username and password.');
            }
            $params["x_auth_username"] = $params['username'];
            $params["x_auth_password"] = $params['password'];
            $params["x_auth_mode"] = 'client_auth';

            unset($params['username']);
            unset($params['password']);
        }

        return $params;
    }
}
