<?php

namespace App\services;

use App\DTO\ClothesDTO;

interface IClothesService{
    public function all() : array;
    public function getById(int $id) : ?ClothesDTO;
    public function update(int $id, ClothesDTO $cloth) : bool;
    public function insert(ClothesDTO $cloth) : bool;
    public function delete(int $id) : bool;
}