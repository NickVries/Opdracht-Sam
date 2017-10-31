<?php

namespace App\Controllers;

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
        if (empty($_POST['name'])) { // Als Post name niet is ingevuld.
            $errors['nameError'] = 'Please make sure to enter your name.';
        }

        if (empty($_POST['age'])) { // Als post age niet is ingevuld.
            $errors['ageError'] = 'Please make sure to enter your age.';
        }

        Session::setFlash('errors', $errors);

        if (!empty($errors)) { // Als er errors zijn.
            return redirect("newUser?name={$_POST['name']}&age={$_POST['age']}");
        }

        if (!empty($_POST['car'])) { // Als er een Post car is:
            if ($_POST['car'] === 'other') { // Als Post car other is:
                Session::setFlash('username', $_POST['username']);
                Session::setFlash('password', $_POST['password']);

                return redirect("newCar?name={$_POST['name']}&age={$_POST['age']}");
            } else { // als post car niet other is.
                $carId = $_POST['car'];
            }
        }
        // Hier heb ik een username en wachtwoord opgeslagen in session.
        // Ook heb ik hier een car ID, name en age.
        if (!empty($_POST['username'])
            && !empty($_POST['password'])
        ) { // Als username en password gegeven zijn in post:
            $userData = [
                'name'     => $_POST['name'],
                'age'      => (int)$_POST['age'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
            ];
        } else { // Als er dus geen username en password gegeven zijn, ofwel als er een nieuwe auto aangemaakt wordt:
            $userData = [
                'name'     => $_POST['name'],
                'age'      => (int)$_POST['age'],
                'username' => Session::getFlash('username'),
                'password' => Session::getFlash('password'),
            ];
        }

        $userId = App::get('database')->insertInto('users', $userData);

        if (!empty($_POST['brand'])) {
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
        $authenticatedUser = Session::get('authenticatedUser');

        $userCarData = [
            'user_id' => $authenticatedUser->id,
            'car_id'  => $_POST['car'],
        ];

        App::get('database')->insertInto('user_car', $userCarData);

        return redirect('');
    }
}
