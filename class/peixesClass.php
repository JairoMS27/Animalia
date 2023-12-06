<?php
/*

    Título: Tarefa 5 - 1 Animalia

    Autor: Jairo.

    Data modificación: 25/11/2023

    Versión 2.0

*/
require_once './class/animalClass.php';

class Peixe extends Animal {

    public function __construct($nombre, $nombreLatin, $imaxe, $categoria,$tipoAleta,$lonxitude){
        parent::__construct($nombre,$nombreLatin,$imaxe,$categoria);
        $this->tipoAleta = $tipoAleta;
        $this->lonxitude = $lonxitude;
    }

    public function emitirBurbullas(){
        return "Glup Glup"; // Devuelve el sonido de las burbujas como "Glup Glup"
    }

    public function getFicha(){
        $ficha = array(
            "nome" => $this->nome,
            "nomeLatin" => $this->nomeLatin,
            "categoria" => $this->categoria, // Devuelve la categoría del animal como "peixes"
            "patas" => $this->getNumPatas(),
            "sangue" => $this->getTipoSangue(),
            "desprazar" => $this->desprazar(),
            "tipoAleta" => $this->tipoAleta,
            "lonxitude" => $this->lonxitude,
            "arquivo" => $this->arquivo,
            "son" => $this->emitirBurbullas()
        );
        return $ficha;

    }
}

?>