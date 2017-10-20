<?php

namespace Nick\Framework\Database;

use Nick\Framework\App;

class Querybuilder
{
    private $pdo;
    private $adults;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function first()
    {
        return reset($this->adults);
    }

    public function where($column, $operator, $value)
    {
        $this->adults = array_filter($this->adults,
            function ($adult) use ($column, $operator, $value) {
                return eval("return \$adult->$column $operator \$value;");
            }
        );

        return $this;
    }

    public function from($table)
    {
        $statement = $this->pdo->prepare("SELECT * FROM {$table}");
        //choose table to retrieve data.
        $statement->execute();

        $this->adults = $statement->fetchAll(\PDO::FETCH_CLASS);

        return $this;
        //return array of all users (objects).
    }

    public static function query()
    {
        return App::get('database');
    }
}
