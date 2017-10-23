<?php

use Nick\Framework\Database\QueryBuilder;
use Nick\Framework\Helpers;
use Nick\Framework\User;

require dirname(dirname(__FILE__)) . '/vendor/autoload.php';

require Helpers::root() . "/core/bootstrap.php";



//$firstAge18Shady = QueryBuilder::query()->from('users')->where('age', '>', 18)->where('name', '=', 'Shady Khattab')->first();

//var_dump($firstAge18Shady);

$user = User::query()->where('age', '>', 18)->first();
//$user = User::query()->where('age', '>', 18)->limit(5)->get();

var_dump($user);
