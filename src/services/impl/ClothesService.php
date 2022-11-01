<?php


namespace App\services\impl;
use App\services\IClothesService;
use App\factories\ClothesFactory;
use App\DTO\ClothesDTO;

class ClothesService implements IClothesService{
    public function all():array{
        return ClothesFactory::getDAO()->read();
    }

    public function getById(int $id):?ClothesDTO{
        return ClothesFactory::getDAO()->findById($id);
    }

    public function update(int $id, ClothesDTO $cloth):bool{
        return ClothesFactory::getDAO()->update($id, $cloth);
    }

    public function insert(ClothesDTO $cloth):bool{
        return ClothesFactory::getDAO()->create($cloth);
    }

    public function delete(int $id):bool{
        return ClothesFactory::getDAO()->delete($id);
    }

}