<?php
/*

    Título: Tarefa 5 - 1 Animalia

    Autor: Jairo.

    Data modificación: 25/11/2023

    Versión 2.0

*/
class Log{
    const logFilePath="modificacionAnimal.log";

    // Metodo para loggear un mensaje
    public static function log($message){
        // Obtener la fecha y hora actual
        $timestamp = date("Y-m-d H:i:s");

        // Formatear el mensaje con la marca de tiempo
        $formattedMessage = "[$timestamp] $message\n";

        // Escribir el mensaje en el archivo de log
        file_put_contents(self::logFilePath, $formattedMessage, FILE_APPEND);
    }

    // Metodo para loggear la creacion de un animal
    public static function logAnimalCreation($animal){
        $message = "Se ha creado un nuevo animal: ($animal->id) $animal->nome";
        self::log($message);
    }
}
?>