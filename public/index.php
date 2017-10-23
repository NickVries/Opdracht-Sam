<?php

use Nick\Framework\Database\QueryBuilder;
use Nick\Framework\Helpers;
use Nick\Framework\User;

require dirname(dirname(__FILE__)) . '/vendor/autoload.php';

require Helpers::root() . "/core/bootstrap.php";



//$firstAge18Shady = QueryBuilder::query()->from('users')->where('age', '>', 18)->where('name', '=', 'Shady Khattab')->first();
//
//var_dump($firstAge18Shady);

//$user = User::query()->where('age', '>', 18)->first();
//$users = User::query()->where('age', '>', 18)->limit(5)->get();
$users = User::query()->where('age', '>', 18)->where('age', '<', 30)->offset(2)->limit(5)->get();
$users = User::query()->offset(2)->where('age', '>', 18)->limit(5)->where('age', '<', 30)->get();
$users = User::query()->where('age', '<', 30)->limit(5)->where('age', '>', 18)->offset(2)->get();
$users = User::query()->offset(2)->where('age', '<', 30)->limit(5)->where('age', '>', 18)->get();
$users = User::query()->limit(5)->offset(2)->where('age', '<', 30)->where('age', '>', 18)->get();

var_dump($users);
