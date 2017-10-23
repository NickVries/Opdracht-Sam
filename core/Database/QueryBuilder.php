<?php

namespace Nick\Framework\Database;

use Nick\Framework\App;
use Nick\Framework\User;

class QueryBuilder
{
    private $pdo;
    private $values = [];
    private $className = \stdClass::class;
    private $where = [];
    private $offset;
    private $limit = 'LIMIT 18446744073709551615';
    private $table;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function first()
    {
        $oldLimit = $this->limit;
        $this->limit = 'LIMIT 1';
        $queryString = $this->queryString();

        $results = $this->execute($queryString);

        $this->limit = $oldLimit;
        return reset($results) ?: null;
    }

    public function where($column, $operator, $value)
    {
//        if (strpos($this->where, 'WHERE') !== false) {
//            $this->where .= " AND {$column} {$operator} ?";
//        } else {
//            $this->where .= " WHERE {$column} {$operator} ?";
//        }

        $this->where[] = "{$column} {$operator} ?";
        $this->values[] = $value;

        return $this;
    }

    public function from($table)
    {
        $this->table = "SELECT * FROM {$table}";

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

    public function limit($limit)
    {
        $this->limit = " LIMIT {$limit}";

        return $this;
    }

    public function get()
    {
        $queryString = $this->queryString();

        $results = $this->execute($queryString);

        return $results;
    }

    public function offset($offset)
    {
        $this->offset = " OFFSET {$offset}";

        return $this;
    }

    private function execute($query)
    {
        $statement = $this->pdo->prepare($query);

        $statement->execute($this->values);

        $results = $statement->fetchAll(\PDO::FETCH_CLASS, $this->className);

        return $results;
    }

    private function queryString()
    {
        $where = $this->where ? 'WHERE ' . implode(' AND ', $this->where) : '';

        return "{$this->table} {$where}  {$this->limit} {$this->offset}";
    }
}
