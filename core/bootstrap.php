<?php

use App\Services\LoginService;
use Nick\Framework\Helpers;

$config = require Helpers::root() . 'config.php';

foreach ($config['providers'] as $provider)
{
    (new $provider)->register();
}

function view($viewName, $data = [])
{
    extract($data);
    return require (Helpers::root() . "app/views/{$viewName}.view.php");
}

function redirect($path)
{
    header("Location: /{$path}");exit();
}
