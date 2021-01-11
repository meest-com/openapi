<?php

namespace Meest\OpenApi\Handlers;

use Meest\OpenApi\Includes\Handler;
use Meest\OpenApi\Includes\Config;

class Auth extends Handler
{
    /**
     *
     * @param $config
     */
    public function __construct(Config $config)
    {
        parent::__construct($config);
    }

    /**
     * New token.
     *
     * @return array
     */
    public function new()
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
            'password' => $this->config->get('password')
        ]);

        $this->dateExpires($token['expiresIn']);

        return $token;
    }

    /**
     * cache token.
     *
     * @return void
     * @throws \Exception
     */
    public function cache()
    {
        try {
            $credential = $this->credential->get();
        } catch (\ErrorException $e) {
            $credential = $this->new();
            $this->credential->set($credential);
        }

        if ($this->checkExpires($credential['expiresIn'])) {
            $credential = $this->refresh($credential['refreshToken']);
            $this->credential->set($credential);
        }

        $this->config->set('credential', $credential);
    }

    /**
     * force token.
     *
     * @return void
     * @throws \Exception
     */
    public function force()
    {
        $credential = $this->new();
        $this->credential->set($credential);
        $this->config->set('credential', $credential);
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

    /**
     * check token expires.
     *
     * @param $time
     * @return bool
     */
    private function checkExpires($time): bool
    {
        return (int) date('U') >= $time;
    }
}
