<?php

use App\Controllers\PagesController;
use App\Controllers\UsersController;

$router->get('', Pagescontroller::class . '@home');
$router->get('404', PagesController::class . '@page404');
$router->get('newUser', PagesController::class . '@newUser');
$router->get('newCar', Pagescontroller::class . '@newCar');

$router->post('users', UsersController::class . '@store');
$router->post('newCar', Pagescontroller::class . '@newCar');
