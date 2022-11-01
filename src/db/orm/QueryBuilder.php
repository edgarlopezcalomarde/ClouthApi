<?php

namespace App\db\orm;

class QueryBuilder{


    public $sql;
    public $table;
    public $fields;
    public $where;
    public $orderby;
    public $params = array();
    public $setfields = [];
    public $values;
    public $set;


    public function __construct(string $table){
        $this->table = $table;
    }

    public function select(?string $fields=null){
        $this->fields = (is_null($fields)? "*" : $fields);
        return $this;
    }

    public function where(array $where){

        $field = $where[0];
        if(count($where)==2){
            $condition = '=';
            $value = $where[1];
        }else{
            $condition = $where[1];
            $value = $where[2];
        }

        return $this;
    }
    public function orderBy(array $orderby){
        $this->orderby = "ORDER BY ". join(" ",$orderby);
        return $this;
    }


    public function find(int $id){
        $this->where(['id', '=', $id]);
        return $this->getOne();
    }

    public function get():array{
        $this->sql = "SELECT $this->fields FROM $this->table $this->where $this->orderby";
        return DB::select($this->sql);
    }

    public function getOne():\stdClass {
        $this->sql = "SELECT $this->fields FROM $this->table $this->where LIMIT 1";
        return DB::selectOne($this->sql);
    }

    public function insert($data){
        $fieldsParams = "";
        foreach ($data as $key => $value) {
            $fieldsParams .= ":$key,";
            $this->params[":$key"] = $value;
        }

        $fieldsParams = rtrim($fieldsParams, ',');
        $fieldsName = implode(",", array_keys($data));
       
        $this->sql = "INSERT INTO $this->table($fieldsName) VALUES ($fieldsParams)";
        return DB::insert($this->sql, $this->params);

    }


    public function delete($param, $id){
        $this->params[":$param"] = $id;
        $this->sql = "DELETE FROM $this->table WHERE $param = :$param";
        return DB::delete($this->sql, $this->params);

    }


    public function update($data){
        foreach ($data as $key => $value) {
            if($key !== "id"){
                $this->set .= "$key = :$key,";
            }else{
                $this->where = "$key = :$key";
            }
            $this->params[":$key"] = $value;
        }

        $this->set = rtrim($this->set, ',');
    
        $this->sql = "UPDATE $this->table SET  $this->set WHERE $this->where";
        return DB::insert($this->sql, $this->params);

    }




    public function toSQL(){
        dd($this->sql);
    }

}