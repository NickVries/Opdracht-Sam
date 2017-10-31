<?php

namespace Nick\Framework\Database;

use App\InsertDuplicateException;
use MongoDB\Driver\Exception\DuplicateKeyException;
use Nick\Framework\App;

class QueryBuilder
{
    /** @var \PDO */
    private $pdo;
    private $values = [];
    private $className = \stdClass::class;
    private $where = [];
    private $offset;
    private $limit = 'LIMIT 18446744073709551615';
    private $table;
    private $select = [];
    private $order;
    private $join = [];

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
        $this->table = "FROM {$table}";

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
        $select = $this->select ? 'SELECT '.implode(', ', $this->select)
            : 'SELECT *';
        $join = $this->join ? implode(' ', $this->join) : '';
        $where = $this->where ? 'WHERE '.implode(' AND ', $this->where) : '';

        return "{$select} {$this->table} {$join} 
                {$where} {$this->order} {$this->limit} {$this->offset}";
    }

    public function select(...$select)
    {
        $this->select = array_merge($this->select, $select);

        return $this;
    }

    public function order($order)
    {
        $this->order = "ORDER BY {$order}";

        return $this;
    }

    public function join($table, $firstColumn, $secondColumn)
    {
        $this->join[] = "INNER JOIN {$table} ON {$firstColumn}={$secondColumn}";

        return $this;
    }

    public function leftJoin($table, $firstColumn, $secondColumn)
    {
        $this->join[] = "LEFT JOIN {$table} ON {$firstColumn}={$secondColumn}";

        return $this;
    }

    public function insertInto($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':'.implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);

            return $this->pdo->lastInsertId();
        } catch (\PDOException $e) {
            if ($e->getCode() === '23000') {
               throw new InsertDuplicateException($e->getMessage());
            }
        }
        return null;
    }
}
