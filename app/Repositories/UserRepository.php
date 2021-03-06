<?php

namespace App\Repositories;

use Nick\Framework\App;
use App\Car;
use App\User;

class UserRepository
{
    public static function getAllUsersWithCars()
    {
        $usersWithCars = App::get('database')
            ->select('users.id', 'users.name', 'users.age', 'cars.brand',
                'cars.color', 'cars.id AS car_id')
            ->from('users')
            ->join('user_car', 'users.id', 'user_car.user_id')
            ->join('cars', 'user_car.car_id', 'cars.id')
            ->order('users.id')
            ->get();

        $newArray = [];

        foreach ($usersWithCars as $user) {
            if (! array_key_exists($user->id, $newArray)) {
                $newUser = new User();
                $newArray[$user->id] = $newUser;
                $newUser->age = $user->age;
                $newUser->name = $user->name;
            }
            if ($user->brand !== NULL) {
                $newCar = new Car();
                $newArray[$user->id]->garage[] = $newCar;
                $newCar->color = $user->color;
                $newCar->brand = $user->brand;
                $newCar->id = $user->car_id;
            }
        }
        return $newArray;
    }
}
