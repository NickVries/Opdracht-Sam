<?php

namespace App\Services;

use App\User;
use Nick\Framework\Cookies;
use Nick\Framework\Database\QueryBuilder;
use Nick\Framework\Session;

class LoginService
{
    public static function checkLogin()
    {
        if (($userId = Cookies::load('userId')))
        {
            $user = QueryBuilder::query()
                ->from('users')
                ->where('id', '=', $userId)
                ->stopHetInMij(User::class)
                ->first();

            Session::store('authenticatedUser', $user);
        }
    }
}