<?php

namespace Meest\OpenApi\Includes;

class Arr
{
    public static function set(&$array, $key, $value): void
    {
        if (is_null($key)) {
            $array = $value;
        } elseif (strpos($key, '.') === false) {
            $array[$key] = $value;
        } else {
            $keys = explode('.', $key);

            foreach ($keys as $i => $key) {
                if (count($keys) === 1) {
                    break;
                }

                unset($keys[$i]);

                if (! isset($array[$key]) || ! is_array($array[$key])) {
                    $array[$key] = [];
                }

                $array = &$array[$key];
            }

            $array[array_shift($keys)] = $value;
        }
    }

    public static function get($array, $key, $default = null)
    {
        if (is_null($key)) {
            return $array;
        }

        if (strpos($key, '.') === false) {
            return $array[$key] ?? $default;
        }

        foreach (explode('.', $key) as $segment) {
            if (is_array($array) && array_key_exists($segment, $array)) {
                $array = $array[$segment];
            } else {
                return $default;
            }
        }

        return $array;
    }
}
