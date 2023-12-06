<?php
/*

    Título: Tarefa 5 - 1 Animalia

    Autor: Jairo.

    Data modificación: 25/11/2023

    Versión 2.0

*/
require_once 'log.php';
 abstract class Animal {
    public $id;
    public $nome;
    public $nomeLatin;
    public $arquivo;
    public $categoria; 
    public $numPatas;
    public $tipoSangue;

    public function __construct($nome, $nomeLatin, $arquivo, $categoria){
        $this->id = uniqid(); // Genera un ID único para el animal
        $this->nome = $nome;
        $this->nomeLatin = $nomeLatin;
        $this->arquivo = $arquivo;
        $this->categoria = $categoria;
        Log::logAnimalCreation($this); // Llama al método logAnimalCreation de la clase Log
    }

    public function getTipoSangue() {
        switch ($this->categoria) {
            case "mamiferos":
            case "aves":
                return "Sangre caliente"; // Devuelve "Sangre caliente" si la categoría del animal es "mamiferos" o "aves"
            case "peixes":
                return "Sangre fría"; // Devuelve "Sangre fría" si la categoría del animal es "peixes"
        }
    }

    public function getNumPatas() {
        switch ($this->categoria) {
            case "mamiferos":
                return 4; // Devuelve 4 si la categoría del animal es "mamiferos"
            case "aves":
                return 2; // Devuelve 2 si la categoría del animal es "aves"
            case "peixes":
                return 0; // Devuelve 0 si la categoría del animal es "peixes"
        }
    }

    public function desprazar() {
        switch ($this->categoria) {
            case "mamiferos":
                return "correndo"; // Devuelve "correndo" si la categoría del animal es "mamiferos"
            case "aves":
                return "voando"; // Devuelve "voando" si la categoría del animal es "aves"
            case "peixes":
                return "nadando"; // Devuelve "nadando" si la categoría del animal es "peixes"
        }
    }

    public function getFicha() {
        $ficha = array(
            "nome" => $this->nome,
            "categoria" => $this->categoria,
            "nomeLatin" => $this->nomeLatin,
            "patas" => $this->getNumPatas(),
            "sangue" => $this->getTipoSangue(),
            "desprazar" => $this->desprazar(),
            "arquivo" => $this->arquivo
        );
        return $ficha;
    }
}
?>
