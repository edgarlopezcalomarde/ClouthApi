<?php

namespace App\DTO;
use JsonSerializable;

class ClothesDTO implements JsonSerializable{

    function __construct(private ?int $id, private string $nombre, private float $precio, private string $imgurl){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->imgurl = $imgurl;
    }


    public function id(): int{
        return $this->id;
    }

    public function nombre(): string{
        return $this->nombre;
    }

    public function precio(): float{
        return $this->precio;
    }

    public function imgurl(): string{
        return $this->imgurl;
    }


    function jsonSerialize(): mixed{
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'precio' => $this->precio,
            'imgurl' => $this->imgurl
        ];
    }

}