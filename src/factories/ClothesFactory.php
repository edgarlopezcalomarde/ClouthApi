<?php

namespace App\factories;
use App\DAO\impl\ClothesBDDAO;
use App\services\impl\ClothesService;


class ClothesFactory{

    public static function getService(): ClothesService{
        return new ClothesService();
    }

    public static function getDAO(): ClothesBDDAO{
        return new ClothesBDDAO();
    }
}