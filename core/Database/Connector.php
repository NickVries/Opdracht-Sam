<?php

namespace Nick\Framework\Database;

class Connector
{
    public static function make($databaseConfig)
    {
        try {
            return new \PDO(
                $databaseConfig['connection'].';dbname='.$databaseConfig['name'],
                $databaseConfig['username'],
                $databaseConfig['password'],
                $databaseConfig['options']
            );
        } catch (\PDOException $e) {
            die ($e->getMessage());
        }
    }
}