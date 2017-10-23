<?php

namespace Nick\Framework;


class User
{
    public static function query()
    {
        return App::get('database')->from('users')->stopHetInMij(User::class);
    }
}