<?php

namespace App\DAO;
use App\DTO\ClothesDTO;

interface IClothesDAO{

    public function create(ClothesDTO $cloth):bool;
    public function read():array;
    public function findById(int $id):ClothesDTO;
    public function update(int $id, ClothesDTO $cloth):bool;
    public function delete(int $id):bool;
}