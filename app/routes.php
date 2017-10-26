<?php

use App\Controllers\PagesController;
use App\Controllers\UsersController;

$router->get('', Pagescontroller::class . '@home');
$router->get('404', PagesController::class . '@page404');
$router->get('newUser', PagesController::class . '@newUser');

$router->post('users', UsersController::class . '@store');
