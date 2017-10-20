<?php

use Nick\Framework\App;
use Nick\Framework\Database\Querybuilder;
use Nick\Framework\Helpers;

require dirname(dirname(__FILE__)) . '/vendor/autoload.php';

require Helpers::root() . "/core/bootstrap.php";

$first = QueryBuilder::query()->from('users')->where('age', '>', 18)->first();

var_dump($first);
