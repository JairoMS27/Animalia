<?php
/*

    Título: Tarefa 5 - 1 Animalia

    Autor: Jairo.

    Data modificación: 25/11/2023

    Versión 2.0

*/
require_once './class/animalClass.php';

class Ave extends Animal {

    public function __construct($nombre, $nombreLatin, $imaxe, $categoria, $tipoPico, $migratoria){
        parent::__construct($nombre,$nombreLatin,$imaxe,$categoria);
        $this->tipoPico = $tipoPico;
        $this->migratoria = $migratoria;
    }


    // Obtiene la ficha del ave con todas sus características
    public function getFicha(){
        $ficha = array(
            "nome" => $this->nome,
            "nomeLatin" => $this->nomeLatin,
            "categoria" => $this->categoria, // Devuelve la categoría del animal como "aves"
            "patas" => $this->getNumPatas(),
            "sangue" => $this->getTipoSangue(),
            "desprazar" => $this->desprazar(),
            "pico" => $this->tipoPico,
            "migratoria" => $this->migratoria,
            "arquivo" => $this->arquivo
        );
        return $ficha;
    }
}

?>