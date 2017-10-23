<?php

namespace Nick\Framework;

class App
{
    public static $registry = [];

    public static function bind($key, $value)
    {
        self::$registry[$key] = $value;
    }

    public static function get($key)
    {
        if (! array_key_exists($key, self::$registry)) {
            throw new \Exception("No {$key} is bound in the container.");
        }

        if (is_callable(self::$registry[$key])) {
            return (self::$registry[$key])();
        }

        return self::$registry[$key];
    }
}