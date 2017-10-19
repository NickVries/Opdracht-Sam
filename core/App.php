<?php

namespace Nick\Framework;

class App
{
    protected static $registry = [];

    public static function bind($key, $value)
    {
        self::$registry[$key] = $value;
    }

    protected static function get($key)
    {
        return self::$registry[$key];
    }
}