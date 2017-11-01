<?php

namespace Nick\Framework;

class Cookies
{
    public static function make($cookieName, $cookieValue, $ttl)
    {
        setcookie($cookieName, $cookieValue, time() + $ttl, '/');
    }
    
    public static function eat($cookieName)
    {
        setcookie($cookieName, '', 0);
    }

    public static function load($cookieName)
    {
        if (isset($_COOKIE[$cookieName]))
        {
            return $_COOKIE[$cookieName];
        }
        return null;
    }
}