<?php
/*

    Título: Tarefa 5 - 1 Animalia

    Autor: Jairo.

    Data modificación: 25/11/2023

    Versión 2.0

*/
require_once './class/peixesClass.php';
require_once './class/avesClass.php';
require_once './class/mamiferosClass.php';

class CallAnimales {
    
    public function __construct(){
        $this->animales = array();
    }

    public function engadirAnimal($animal){
        array_push($this->animales, $animal); // Añade un animal al array de animales
    }

    public function listarAnimais(){
        return $this->animales; // Devuelve el array de animales
    }

    public function listarAnimaisCategoria($categoria){
        $animaisCategoria = array();
        foreach ($this->animales as $animal) {
            if ($animal->categoria == $categoria) { // Si la categoría del animal es igual a la categoría pasada como parámetro
                array_push($animaisCategoria, $animal); // Añade el animal al array de animales de la categoría
            }
        }
        return $animaisCategoria; // Devuelve el array de animales de la categoría
    }

    public function engadirMamifero ($nome, $nomeLatin, $imaxe, $categoria, $tipoPelaxe, $emitirSon){
        $mamifero = new Mamifero($nome, $nomeLatin, $imaxe, $categoria, $tipoPelaxe, $emitirSon);
        $this->engadirAnimal($mamifero); // Añade un mamífero al array de animales
    }

    public function engadirAve ($nome, $nomeLatin, $imaxe, $categoria, $tipoPico, $migratoria){
        $ave = new Ave($nome, $nomeLatin, $imaxe, $categoria, $tipoPico, $migratoria);
        $this->engadirAnimal($ave); // Añade un ave al array de animales
    }

    public function engadirPeixe ($nome, $nomeLatin, $imaxe, $categoria, $tipoAleta, $lonxitude){
        $peixe = new Peixe($nome, $nomeLatin, $imaxe, $categoria, $tipoAleta, $lonxitude);
        $this->engadirAnimal($peixe); // Añade un pez al array de animales
    }

    public function getAnimalbyID($id){
        foreach ($this->animales as $animal) {
            if ($animal->id == $id) { // Si el ID del animal es igual al ID pasado como parámetro
                return $animal; // Devuelve el animal
            }
        }
    }


}
?>