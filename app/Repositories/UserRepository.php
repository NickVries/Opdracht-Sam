<?php

namespace App\Repositories;

use Nick\Framework\User;
use Nick\Framework\Database\QueryBuilder;

class UserRepository
{
    public static function getAllUsersWithCars()
    {
        $usersWithCars = User::query()
            ->select('users.name', 'cars.brand', 'cars.color')
            ->join('user_car', 'users.id', 'user_car.user_id')
            ->join('cars', 'user_car.car_id', 'cars.id')
            ->order('users.id')
            ->get();

        return array_values(array_unique($usersWithCars, SORT_REGULAR));
    }
}
