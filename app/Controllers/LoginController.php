<?php

namespace App\Controllers;

use Nick\Framework\Cookies;
use Nick\Framework\Database\QueryBuilder;
use Nick\Framework\Session;

class LoginController
{
        public function login($errors = [])
    {
        $authenticatedUser = Session::get('authenticatedUser');
        return view('login', compact('errors', 'authenticatedUser'));
    }

    public function logout()
    {
        Session::remove('authenticatedUser');
        Cookies::eat('user');
        redirect('');
    }

    public function loginPost()
    {
        $errors = [];

        if (empty($_POST['username'])) {
            $errors['usernameError']
                = 'Please make sure to enter your username.';
        }

        if (empty($_POST['password'])) {
            $errors['passwordError']
                = 'Please make sure to enter your password.';
        }

        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $user = QueryBuilder::query()
                ->select('id', 'name', 'username', 'age')
                ->from('users')
                ->where('username', '=', $_POST['username'])
                ->where('password', '=', $_POST['password'])
                ->first();

            Session::store('authenticatedUser', $user);

            if ($user === null) {
                $errors['loginFailed']
                    = 'The combination of username and password is not valid.';
            } else {
                Cookies::make('userId', $user->id, 30);
                return redirect('');
            }
        }

        return $this->login($errors);
    }
}
