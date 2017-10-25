<?php

namespace Nick\Framework;


class User
{
    public static function query()
    {
        return App::get('database')->from('users');
    }

    public function getCars()
    {
        return App::get('database')
            ->select('cars.brand, cars.color')
            ->from('cars')
            ->join('user_car', 'cars.id', 'user_car.car_id')
            ->join('users', 'user_car.user_id', 'users.id')
            ->order('cars.id')
            ->stopHetInMij(Car::class)
            ->get();
    }
}
