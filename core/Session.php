<?php

namespace Nick\Framework;

class Session
{
    public static function store($key, $value)
    {
        session_start();

        $_SESSION['perm'][$key] = $value;
    }

    public static function get($key)
    {
        session_start();

        return $_SESSION['perm'][$key];
    }

    public static function setFlash($key, $value)
    {
        session_start();

        $_SESSION['temp'][$key] = $value;
    }

    public static function getFlash($key)
    {
        session_start();

        if (!array_key_exists($key, $_SESSION['temp']))
        {
            return null;
        }

        $value = $_SESSION['temp'][$key];

        unset($_SESSION['temp'][$key]);

        return $value;
    }
}