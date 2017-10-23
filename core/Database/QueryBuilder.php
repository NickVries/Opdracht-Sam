<?php

namespace Nick\Framework\Database;

use Nick\Framework\App;

class QueryBuilder
{
    private $pdo;
    private $query;
    private $values = [];

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function first()
    {
        $statement = $this->pdo->prepare("{$this->query} LIMIT 1");


        $statement->execute($this->values);

        $user = $statement->fetchAll(\PDO::FETCH_CLASS);

        return reset($user) ?: null;
    }

    public function where($column, $operator, $value)
    {
        if (strpos($this->query, 'WHERE') !== false) {
            $this->query .= " AND {$column} {$operator} ?";
        } else {
            $this->query .= " WHERE {$column} {$operator} ?";
        }

        $this->values[] = $value;

        return $this;
    }

    public function from($table)
    {
        $this->query = "SELECT * FROM {$table}";

        return $this;
    }

    public static function query()
    {
        return App::get('database');
    }
}
