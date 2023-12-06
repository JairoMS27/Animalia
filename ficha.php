<?php
/*

    Título: Tarefa 5 - 1 Animalia

    Autor: Jairo.

    Data modificación: 25/11/2023

    Versión 2.0

*/

// Incluye los archivos de las clases necesarias
require_once './class/callAnimalesClass.php';

// Inicia la sesión
session_start();

// Obtiene el ID del animal desde la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "ID no especificado";
    exit;
}

// Inicializa los arrays de animales
$animal = $_SESSION['animales']->getAnimalbyID($id);

// Comprueba si se encontró un animal con el ID dado
if (!isset($animal)) {
    echo "Animal no encontrado";
} else {
    // Obtiene los datos de la ficha del animal
    $ficha = $animal->getFicha();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Ficha de <?php echo $ficha['nome']; ?></title>
</head>
<body> 
<h1>Ficha de <?php echo $ficha['nome']; ?></h1>
<img class="img-animal" src='./arquivos/<?php echo $ficha['arquivo']; ?>' alt='<?php echo $ficha['nome']; ?>'>

<!-- Muestra los datos del animal -->
<p>Nombre: <?php echo $ficha['nome']; ?></p>
<p>Nombre en latín: <?php echo $ficha['nomeLatin']; ?></p>
<p>Número de patas: <?php echo $ficha['patas']; ?></p>
<p>Tipo de sangre: <?php echo $ficha['sangue']; ?></p>
<p>Se desplaza: <?php echo $ficha['desprazar']; ?></p>

<!-- Muestra datos específicos según el tipo de animal -->
<?php if ($animal->categoria == 'mamiferos'): ?>
    <p>Emitir Sonido: <?php echo $ficha['sonido']; ?></p>
    <p>Tipo de Pelaje: <?php echo $ficha['pelaxe']; ?></p>
<?php elseif ($animal->categoria == 'aves'): ?>
    <p>Migratoria: <?php echo $ficha['migratoria']; ?></p>
    <p>Tipo de Pico: <?php echo $ficha['pico']; ?></p>
<?php elseif ($animal->categoria == 'peixes'): ?>
    <p>Emitir Burbujas: <?php echo $ficha['son']; ?></p>
    <p>Longitud: <?php echo $ficha['lonxitude']; ?></p>
    <p>Tipo de Aleta: <?php echo $ficha['tipoAleta']; ?></p>
<?php endif; ?>

<a href="animalia.php" class="btn">Volver</a>
</body>
</html>

<?php
}
?>