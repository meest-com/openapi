<?php

namespace Meest\OpenApi\Handlers;

use Meest\OpenApi\Includes\Handler;

class Auth extends Handler
{
    /**
     * New token.
     *
     * @return array
     * @throws \Exception
     */
    public function create()
    {
        $token = $this->request->get('POST', $this->getUrl('urls.auth.getToken'), [
            'username' => $this->config->get('username'),
            'password' => $this->config->get('password')
        ]);

        $this->dateExpires($token['expiresIn']);

        return $token;
    }

    /**
     * Refresh token.
     *
     * @param $token
     * @return array
     */
    public function refresh($token)
    {
        $token = $this->request->get('POST', $this->getUrl('urls.auth.refreshToken'), [
            'refreshToken' => $token,
        ]);

        $this->dateExpires($token['expiresIn']);

        return $token;
    }

    /**
     * date token expires.
     *
     * @param $time
     * @return void
     */
    private function dateExpires(&$time)
    {
        $time = $time + date('U');
    }
}
