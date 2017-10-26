<?php

namespace App\Controllers;

use Nick\Framework\App;
use Nick\Framework\Database\QueryBuilder;

class UsersController
{
    public function index()
    {
        $users = App::get('database')->selectAll('users');

        return view('users', compact('users'));
    }

    public function store()
    {
        $userData = [
            'name' => $_POST['name'],
            'age'  => (int)$_POST['age'],
        ];

        $userId = App::get('database')->insertInto('users', $userData);

        $userCarData =[
            'user_id' => $userId,
            'car_id' => $_POST['car'],
        ];

        App::get('database')->insertInto('user_car', $userCarData);

        return redirect('');
    }
}
