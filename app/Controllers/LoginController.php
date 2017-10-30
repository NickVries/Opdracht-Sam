<?php

namespace App\Controllers;

use Nick\Framework\Database\QueryBuilder;
use Nick\Framework\Session;

class LoginController
{
    public function login()
    {
        $errors = [];
        if (empty($_POST['username'])) {
            $errors['usernameError']
                = 'Please make sure to enter your username';
        }

        if (empty($_POST['password'])) {
            $errors['passwordError']
                = 'Please make sure to enter your password';
        }

//        if (!empty($errors)) {
//            return redirect("login");
//        }

        $user = QueryBuilder::query()
            ->select('id', 'name')
            ->from('users')
            ->where('username', '=', $_POST['username'])
            ->where('password', '=', $_POST['password'])
            ->first();

        Session::store($user->id, 'logged in');

// Check of username + password combi bestaat in database.
// If so, set $_SESSION['user'] = logged in.
// redirect to home page.

        return view('login', 'errors');
    }
}