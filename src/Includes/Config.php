<?php

namespace Meest\OpenApi\Includes;

class Config
{
    private $array = [];

    public function __construct($array = [])
    {
        $this->load();

        if (!empty($array)) {
            $this->merge($array);
        }
    }

    public function load(): void
    {
        if ($this->array === []) {
            $this->array = require(__DIR__.'/../../config/main.php');
        }
    }

    public function set($key, $value): void
    {
        Arr::set($this->array, $key, $value);
    }

    public function get($key, $default = null)
    {
        return Arr::get($this->array, $key, $default);
    }

    public function merge($array = []): void
    {
        $this->array = array_replace_recursive($this->array, $array);
    }
}
