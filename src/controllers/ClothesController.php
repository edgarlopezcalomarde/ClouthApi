<?php

namespace App\controllers;

use App\factories\ClothesFactory;
use App\response\HTTPResponse;
use App\DTO\ClothesDTO;

class ClothesController{

    public function all(){   
        HTTPResponse::json(200,ClothesFactory::getService()->all());
    }

    public function getById(int $id){
        try{
            HTTPResponse::json(200, ClothesFactory::getService()->getById($id));
        }catch(\Exception $e){
            HTTPResponse::json($e->getCode(), $e->getMessage());
        }

    }
    
    public function insert(){
        try{
            $data = json_decode(file_get_contents('php://input'), true);

            if(isset($data["nombre"]) && isset($data["precio"]) && isset($data["imgurl"])){
                ClothesFactory::getService()->insert(new ClothesDTO(null,$data["nombre"], $data["precio"], $data["imgurl"]));
                HTTPResponse::json(201, "Recurso generado correctamente");
            }else{
                throw new \Exception("No se puede acceder al recurso enviado", 400);
            }

        }catch(\Exception $e){
            HTTPResponse::json($e->getCode(), $e->getMessage());
        }
    }
    public function update(int $id){
        try{
            $data = json_decode(file_get_contents("php://input"), true);

            //$data2 = json_decode(file_get_contents("php://input"));
            //echo $data2->nombre;

            if(isset($data["nombre"]) && isset($data["precio"]) && isset($data["imgurl"])){ 
                HTTPResponse::json(200, ClothesFactory::getService()->update($id, new ClothesDTO(null,$data["nombre"], $data["precio"], $data["imgurl"])));
            }else{
                throw new \Exception("No se puede acceder al recurso enviado", 400);
            }
     
        }catch(\Exception $e){
            HTTPResponse::json($e->getCode(), $e->getMessage());
        }
    }


    public function delete(int $id){
        try{
            HTTPResponse::json(200, ClothesFactory::getService()->delete($id));
        }catch(\Exception $e){
            HTTPResponse::json($e->getCode(), $e->getMessage());
        }
    }

}