<?php

namespace App\Providers;

use Nick\Framework\App;
use Nick\Framework\Contracts\ServiceProviderInterface;
use Nick\Framework\Helpers;

class AppServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        App::bind('config', require Helpers::root() . 'config.php');
    }
}
