<?php

namespace Nick\Framework;

class Helpers
{
    /**
     * Return the path of the root directory.
     *
     * @return string
     */
    public static function root()
    {
        return dirname(dirname(__FILE__)) . '/';
    }
}
