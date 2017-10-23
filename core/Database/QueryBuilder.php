<?php

namespace Nick\Framework\Database;

use Nick\Framework\App;
use Nick\Framework\User;

class QueryBuilder
{
    private $pdo;
    private $query;
    private $values = [];
    private $className = \stdClass::class;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function first()
    {
        $statement = $this->pdo->prepare("{$this->query} LIMIT 1");

        $statement->execute($this->values);

        $query = $statement->fetchAll(\PDO::FETCH_CLASS, $this->className);

        return reset($query) ?: null;
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

    public function stopHetInMij($className)
    {
        $this->className = $className;

        return $this;
    }

    public function limit($number)
    {
        $this->query .= " LIMIT $number";

        return $this;
    }

    public function get()
    {
        $statement = $this->pdo->prepare($this->query);

        $statement->execute($this->values);

        $users = $statement->fetchAll(\PDO::FETCH_CLASS, $this->className);

        return $users;
    }
}
