<?php

namespace Nick\Framework;

class User
{
    public $name;
    public $age;
    public $garage = [];

    public static function query()
    {
        return App::get('database')->from('users')->stopHetInMij(User::class);
    }

    public function getCars()
    {
        return $this->garage;
    }

    public function getCarCount()
    {
        return count($this->garage);
    }
}
