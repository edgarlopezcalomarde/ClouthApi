<?php

namespace App\DAO\impl;
use App\DAO\IClothesDAO;
use App\db\orm\DB;
use App\DTO\ClothesDTO;


class ClothesBDDAO implements IClothesDAO{

    public function create(ClothesDTO $clothes):bool{
        $insertedRow = DB::table("products")->insert([
            "nombre"=>$clothes->nombre(),
            "precio"=>$clothes->precio(),
            "imgurl"=>$clothes->imgurl()
        ]);
        return ($insertedRow>0)? true: false;
    }

    public function read():array{

        $result = [];
        $db_data = DB::table("products")->select()->get();

        foreach($db_data as $key => $cloth){
            array_push($result, new ClothesDTO(
                $cloth->id,
                $cloth->nombre,
                $cloth->precio,
                $cloth->imgurl
            ));
        }

    

        return $result;
    }

    public function findById($id):ClothesDTO{

        $cloth =  DB::table("products")->select()->find($id);
        return new ClothesDTO( $cloth->id, $cloth->nombre, $cloth->precio, $cloth->imgurl);
    }

    public function update($id, ClothesDTO $clothes):bool{

        $updateRow = DB::table("products")->update([
            "id"=>$id,
            "nombre"=>$clothes->nombre(),
            "precio"=>$clothes->precio(),
            "imgurl"=>$clothes->imgurl()
        ]);

        return ($updateRow>0)? true: false;

    }

    public function delete($id):bool{
        $deletedRow = DB::table("products")->delete("id",$id);
        return ($deletedRow>0)? true: false;
    }
    

}