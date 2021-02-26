<?php

namespace Meest\OpenApi;

use Meest\OpenApi\Includes\Config;
use Meest\OpenApi\Includes\Credential;

class OpenApi
{
    private $config;
    private $credential;

    public function __construct($config = [])
    {
        $this->config = new Config($config);
        $this->credential = new Credential($this->config);
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
     * cache token.
     *
     * @return self
     * @throws \Exception
     */
    public function saveToken()
    {
        $this->credential->cache();

        return $this;
    }
}
