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
        if ($_POST['car'] === 'other') {
            return redirect("newCar?name={$_POST['name']}&age={$_POST['age']}");
        } else {
            $carId = $_POST['car'];
        }

        $userData = [
            'name' => $_POST['name'],
            'age'  => (int)$_POST['age'],
        ];

        $userId = App::get('database')->insertInto('users', $userData);

        if ($_POST['brand'] !== null) {
            $carData = [
                'brand' => $_POST['brand'],
                'color' => $_POST['color'],
            ];

            $carId = App::get('database')->insertInto('cars', $carData);
        }

        $userCarData = [
            'user_id' => $userId,
            'car_id'  => $carId,
        ];

        App::get('database')->insertInto('user_car', $userCarData);

        return redirect('');
    }
}
