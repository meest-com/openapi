<?php

namespace Meest\OpenApi;

use Meest\OpenApi\Handlers\Auth;
use Meest\OpenApi\Includes\Config;

class OpenApi
{
    private $config;
    private $auth;

    public function __construct($config = [])
    {
        $this->config = new Config();

        if (!empty($config)) {
            $this->config->merge($config);
        }
    }

    /**
     * Call handler.
     *
     * @param $name
     * @param array $arguments
     * @return self
     */
    public function __call($name, $arguments = [])
    {
        $arguments = array_merge($arguments, [$this->config]);

        $class = 'Meest\\OpenApi\\Handlers\\'.ucfirst($name);

        return new $class(...$arguments);
    }

    /**
     * Merge configs.
     *
     * @param array $array
     * @return self
     */
    public function config($array = [])
    {
        $this->config->merge($array);

        return $this;
    }

    /**
     * Call auth handler.
     *
     * @return self
     */
    public function auth()
    {
        $this->auth = new Auth($this->config);

        return $this;
    }

    /**
     * get new token.
     *
     * @return array
     */
    public function new()
    {
        return $this->auth->new();
    }

    /**
     * refresh token.
     *
     * @param $token
     * @return array
     */
    public function refresh($token)
    {
        return $this->auth->refresh($token);
    }

    /**
     * cache token.
     *
     * @return self
     */
    public function cache()
    {
        $this->auth->cache();

        return $this;
    }
}
