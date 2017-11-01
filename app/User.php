<?php

namespace App;

use Nick\Framework\App;

class User
{
    public $name;
    public $age;
    public $garage = [];
    protected $username;
    protected $password;

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
