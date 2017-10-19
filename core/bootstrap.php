<?php

use Nick\Framework\Helpers;

$config = require Helpers::root() . 'config.php';

foreach ($config['providers'] as $provider)
{
    (new $provider)->register();
}
