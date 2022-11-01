<?php

namespace App\factories;
use App\db\impl\MysqlPDO;

class BDFactory{

    public static function getConnection(){
        return new MysqlPDO();
    }
}