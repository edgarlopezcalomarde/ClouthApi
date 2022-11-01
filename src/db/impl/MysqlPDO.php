<?php

namespace App\db\impl;
use App\db\IPDOConnection;

class MysqlPDO implements IPDOConnection{
    public static function connect(): \PDO{
        try{

            $pdo = new \PDO($_ENV['DB_TYPE'].":host=".$_ENV['HOST'].";dbname=".$_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            $pdo->exec("set names utf8");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;

        }catch(\PDOException $e){
            throw new \PDOException("Error no se ha podido conectar a la base de datos", 500);
        }
    }
}