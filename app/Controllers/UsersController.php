<?php

namespace App\Controllers;

use Nick\Framework\App;
use App\InsertDuplicateException;

class UsersController
{
    public function index()
    {
        return view('users', [
            'users' => App::get('database')->selectAll('users'),
        ]);
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

            try {
                $carId = App::get('database')->insertInto('cars', $carData);
            } catch (InsertDuplicateException $e) {
                $carId = App::get('database')
                    ->from('cars')
                    ->select('id')
                    ->where('color', '=', $_POST['color'])
                    ->where('brand', '=', $_POST['brand'])
                    ->first()
                    ->id;
            }
        }

        $userCarData = [
            'user_id' => $userId,
            'car_id'  => $carId,
        ];

        App::get('database')->insertInto('user_car', $userCarData);

        return redirect('');
    }

    public function addCarToUser()
    {
        $userId = App::get('database')
            ->select('id')
            ->from('users')
            ->where('name', '=', $_POST['name'])
            ->where('age', '=', $_POST['age'])
            ->first()
            ->id;

        $userCarData = [
            'user_id' => $userId,
            'car_id'  => $_POST['car'],
        ];

        App::get('database')->insertInto('user_car', $userCarData);

        return redirect('');
    }
}
