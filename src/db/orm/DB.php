<?php

namespace App\db\orm;
use App\db\orm\QueryBuilder;
use App\factories\BDFactory;


class DB{

    public static function select(string $sql, ?array $params = null){
        $result = array();
        $data = self::execute($sql, $params); 

        foreach($data as $record){
            $result []= (object) $record;
        }

        return $result;
        throw new \Exception("No se ha podido encontrar ningun producto");
    }

    public static function selectOne(string $sql, ?array $params = null){
        $data = self::execute($sql, $params);
        if(count($data)>0){
            return (object) $data[0];
        }

        throw new \Exception("No se ha podido encontrar el producto con esa ID");
    }

    public static function insert(string $sql, ?array $params = null){
        return self::executeNoResult($sql, $params);  
    }

    public static function delete(string $sql, ?array $params = null){
        return self::executeNoResult($sql, $params);  
    }

    public static function update(string $sql, ?array $params = null){
        return self::executeNoResult($sql, $params);
    }

    public static function execute(string $sql, ?array $params = null):array{
        $pdo = BDFactory::getConnection()->connect();
        $ps = $pdo->prepare($sql);
        $ps->execute($params);
        return $ps->fetchAll(\PDO::FETCH_ASSOC);    
    }

    public static function executeNoResult(string $sql, ?array $params = null):int{
        $pdo = BDFactory::getConnection()->connect();

        try{
            $ps = $pdo->prepare($sql);
            $ps->execute($params);

            return $ps->rowCount();
        }catch(\Exception $e){
            throw new Exception("Error al tramitar el recurso", 400);
        }
        
    }

    public static function table(string $table): QueryBuilder{
        return new QueryBuilder($table);
    }

}