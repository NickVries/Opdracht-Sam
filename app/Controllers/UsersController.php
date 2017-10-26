<?php

namespace App\Controllers;

use Nick\Framework\App;

class UsersController
{
    public function index()
    {
        $users = App::get('database')->selectAll('users');

        return view('users', compact('users'));
    }

    public function store()
    {
        $data = [
            'name' => $_POST['name'],
            'age'  => (int)$_POST['age'],
            'car'  => $_POST['car'],
        ];

        App::get('database')->insertInto('users', $data);

//        $url = "/usercreated?name=" . urlencode($data['firstname'] . ' ' . $data['lastname']);
//
//        header("Location: {$url}");
        return redirect('users');
    }
}
