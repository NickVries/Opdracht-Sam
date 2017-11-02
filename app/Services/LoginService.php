<?php

namespace App\Services;

use App\User;
use Nick\Framework\App;
use Nick\Framework\Cookies;
use Nick\Framework\Database\QueryBuilder;
use Nick\Framework\Session;

class LoginService
{
    public function checkLogin()
    {
        if ($this->getUser())
        {
            return true;
        }

        if (($userId = Cookies::load('userId')))
        {
            $user = QueryBuilder::query()
                ->from('users')
                ->where('id', '=', $userId)
                ->stopHetInMij(User::class)
                ->first();

            $this->storeUser($user);

            if ($user){
                return true;
            }
        }

        if  (($accessToken = Session::get('accessToken')))
        {
            $user = App::get('githubService')->getUser($accessToken);

            $this->storeUser($user);

            return true;
        }

        return false;
    }

    public function getUser()
    {
        return Session::get('authenticatedUser');
    }

    public function storeUser($user)
    {
        Session::store('authenticatedUser', $user);
    }

    public function logout()
    {
        Session::remove('authenticatedUser');
        Session::remove('accessToken');
        Cookies::eat('user');
    }
}