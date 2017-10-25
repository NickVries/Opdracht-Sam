<?php

use Nick\Framework\Database\QueryBuilder;
use Nick\Framework\Helpers;
use Nick\Framework\User;

require dirname(dirname(__FILE__)) . '/vendor/autoload.php';

require Helpers::root() . "/core/bootstrap.php";



//$firstAge18Shady = QueryBuilder::query()->from('users')->where('age', '>', 18)->where('name', '=', 'Shady Khattab')->first();
//var_dump($firstAge18Shady);

//$users = User::query()->where('age', '>', 18)->where('age', '<', 30)->offset(2)->limit(5)->get();
//$users = User::query()->limit(5)->offset(2)->where('age', '<', 30)->where('age', '>', 18)->get();
//$querybuilder = User::query()->offset(2)->where('age', '<', 30)->where('age', '>', 18);
//$firstUser = $querybuilder->first();
//$allUsers = $querybuilder->get();
//$users = User::query()->get();
