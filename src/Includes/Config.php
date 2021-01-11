<?php

namespace Meest\OpenApi\Includes;

class Config
{
    private $array = [];

    public function __construct()
    {
        $this->load();
    }

    public function load(): void
    {
        if ($this->array === []) {
            $this->array = require(__DIR__.'/../../config/main.php');
        }
    }

    public function set($key, $value): void
    {
        if (is_null($key)) {
            $this->array = $value;
        }

        if (strpos($key, '.') === false) {
            $this->array[$key] = $value;
        } else {
            foreach (explode('.', $key) as $segment) {
                if (!isset($this->array[$key]) || ! is_array($this->array[$key])) {
                    $array[$key] = [];
                }

                $array = &$array[$key];
            }

            $array[array_shift($keys)] = $value;
        }
    }

    public function get($key, $default = null)
    {
        if (is_null($key)) {
            return $this->array;
        }

        if (strpos($key, '.') === false) {
            return $this->array[$key] ?? $default;
        }

        $array = $this->array;

        foreach (explode('.', $key) as $segment) {
            if (is_array($array) && array_key_exists($segment, $array)) {
                $array = $array[$segment];
            } else {
                return $default;
            }
        }

        return $array;
    }

    public function merge($arr = []): void
    {
        $this->array = array_merge($this->array, $arr);
    }

    public function del($key): void
    {
        unset($this->array[$key]);
    }
}
