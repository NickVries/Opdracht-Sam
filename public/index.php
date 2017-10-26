<?php

use App\Repositories\UserRepository;
use Nick\Framework\Helpers;
use Nick\Framework\Request;
use Nick\Framework\Router;

require dirname(dirname(__FILE__)) . '/vendor/autoload.php';

require Helpers::root() . "/core/bootstrap.php";

$routes = (Helpers::root() . '/app/routes.php');

Router::load($routes)
    ->direct(Request::uri(), Request::method());
