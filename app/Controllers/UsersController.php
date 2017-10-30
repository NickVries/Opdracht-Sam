<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use Nick\Framework\App;
use App\InsertDuplicateException;
use Nick\Framework\Session;

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
        $errors = [];
        if (empty($_POST['name'])) {
            $errors['nameError'] = 'Please make sure to enter your name';
        }

        if (empty($_POST['age'])) {
            $errors['ageError'] = 'Please make sure to enter your age';
        }

        Session::setFlash('errors', $errors);

        if (!empty($errors)) {
                return redirect("newUser?name={$_POST['name']}&age={$_POST['age']}");
        }

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
        $userCarData = [
            'user_id' => $_POST['id'],
            'car_id'  => $_POST['car'],
        ];

        App::get('database')->insertInto('user_car', $userCarData);

        return redirect('');
    }
}
