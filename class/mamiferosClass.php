<?php
/*

    Título: Tarefa 5 - 1 Animalia

    Autor: Jairo.

    Data modificación: 25/11/2023

    Versión 2.0

*/
require_once './class/animalClass.php';

class Mamifero extends Animal {

    public function __construct($nombre, $nombreLatin, $imaxe, $categoria, $tipoPelaxe, $emitirSon){
        parent::__construct($nombre,$nombreLatin,$imaxe,$categoria);
        $this->tipoPelaxe = $tipoPelaxe;
        $this->emitirSon = $emitirSon;
    }

    public function getFicha(){
        $ficha = array(
            "nome" => $this->nome,
            "nomeLatin" => $this->nomeLatin,
            "categoria" => $this->categoria, // Devuelve la categoría del animal como "mamiferos"
            "patas" => $this->getNumPatas(),
            "sangue" => $this->getTipoSangue(),
            "desprazar" => $this->desprazar(),
            "pelaxe" => $this->tipoPelaxe,
            "sonido" => $this->emitirSon,
            "arquivo" => $this->arquivo
        );
        return $ficha;

    }
}

?>