<?php

use App\Repositories\UserRepository;
use Nick\Framework\App;
use Nick\Framework\Database\QueryBuilder;
use Nick\Framework\Helpers;
use Nick\Framework\User;

require dirname(dirname(__FILE__)) . '/vendor/autoload.php';

require Helpers::root() . "/core/bootstrap.php";

//$userscars = QueryBuilder::query()
//    ->select('users.name, cars.color, cars.brand')
//    ->from('users')
//    ->join('user_car', 'users.id', 'user_car.user_id')
//    ->join('cars', 'user_car.car_id', 'cars.id')
//    ->order('users.id')
//    ->get();

$usersWithCars = UserRepository::getAllUsersWithCars();



require Helpers::root() . "app/views/index.view.php";
