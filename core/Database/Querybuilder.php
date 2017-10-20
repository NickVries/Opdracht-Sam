<?php

namespace Nick\Framework\Database;

use Nick\Framework\App;

class Querybuilder
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function first()
    {
        return $this[0];
    }

    public function where($column, $operator, $value)
    {
        
        //Filter array of users to filter out users based on $column and $value.
        //return array of users where conditions apply.
    }

    public function from($table)
    {
        $statement = $this->pdo->prepare("SELECT * FROM {$table}");
        //choose table to retrieve data.
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS);
        //return array of all users (objects).
    }


    public static function query()
    {
        return App::get('database');
        // returns PDO object.
    }

}