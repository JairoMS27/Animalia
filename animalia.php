<?php
/*

    Título: Tarefa 5 - 1 Animalia

    Autor: Jairo.

    Data modificación: 25/11/2023

    Versión 2.0

*/
require_once './class/callAnimalesClass.php';

// Inicia la sesión
session_start();

// Inicializa los arrays de animales
if (!isset($_SESSION['animales'])) {
  $_SESSION['animales'] = new CallAnimales();
}

$animales = $_SESSION['animales'];


// Errores de validación
$errorNome = "";
$errorNomeLatin = "";
$errorArquivo = "";
$errorTipos = "";
$errorCaracteristica1 = "";
$errorCaracteristica2 = "";

// Procesamiento del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Validación de campos

  // Verifica si el campo "nomeAnimal" está definido
  if (isset($_POST["nomeAnimal"])) {
    $nome = filter_var($_POST["nomeAnimal"]);
    if (empty($nome)) {
      $errorNome = "Debe cubrir el campo nombre";
    }
  }

  // Verifica si el campo "nomeLatin" está definido
  if (isset($_POST["nomeLatin"])) {
    $nomeLatin = filter_var($_POST["nomeLatin"]);
    if (empty($nomeLatin)) {
      $errorNomeLatin = "Debe cubrir el campo nombre latín";
    }
  }

  // Verifica si el campo "tipos" está definido
  if (isset($_POST["tipos"])) {
    $tipos = filter_var($_POST["tipos"]);
    if (empty($tipos)) {
      $errorTipos = "Debe cubrir el campo tipos";
    }
  }

  // Verifica si el campo "caracteristica1" está definido
  if (isset($_POST["caracteristica1"])) {
    $caracteristica1 = filter_var($_POST["caracteristica1"]);
    if (empty($caracteristica1)) {
      $errorCaracteristica1 = "Debe cubrir el campo caracteristica 1";
    }
  }

  // Verifica si el campo "caracteristica2" está definido
  if (isset($_POST["caracteristica2"])) {
    $caracteristica2 = filter_var($_POST["caracteristica2"]);
    if (empty($caracteristica2)) {
      $errorCaracteristica2 = "Debe cubrir el campo caracteristica 2";
    }
  }

  // Verifica si el archivo "arquivo" está definido y no tiene errores
  if (isset($_FILES["arquivo"]) && $_FILES["arquivo"]["error"] == 0) {

    $nomeTemporal = $_FILES["arquivo"]["tmp_name"];
    $nomeArquivo = $_POST['nomeLatin'];

    // Mover el archivo temporal a una ubicación específica
    $destino = "arquivos/" . $nomeArquivo . ".jpeg";

    if (move_uploaded_file($nomeTemporal, $destino)) {
      echo "El archivo se cargó correctamente.";
    } else {
      echo "Hubo un error al cargar el archivo.";
    }

    // Agregar el nuevo animal al array correspondiente
    switch ($tipos) {
      case 'aves':
        $animales->engadirAve($nome, $nomeLatin, $nomeArquivo . '.jpeg', $tipos, $caracteristica1, $caracteristica2);
        break;
      case 'mamiferos':
        $animales->engadirMamifero($nome, $nomeLatin, $nomeArquivo . '.jpeg', $tipos, $caracteristica1, $caracteristica2);
        break;
      case 'peixes':
        $animales->engadirPeixe($nome, $nomeLatin, $nomeArquivo . '.jpeg', $tipos, $caracteristica1, $caracteristica2);
        break;
      default:
        break;
    }

  } else {
    // Comprobar si existe una foto de perfil para el animal
    echo "Por favor elija un archivo válido";
  }

  header("Location: animalia.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Animalia</title>
</head>

<body>
  <div class="container">
    <div class="formulario">
      <fieldset class="datos">
        <legend>Datos do animal</legend>
        <form id="formulario" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
          <input class="inputs" id="nome" name="nomeAnimal" type="text" placeholder="(nome)" required><br>
          <span style='font-size: smaller; color: red;'><?php echo $errorNome; ?></span>
          <input class="inputs" id="nomeLatin" name="nomeLatin" type="text" placeholder="(nome latín)" required><br>
          <span style='font-size: smaller; color: red;'><?php echo $errorNomeLatin; ?></span>
          <input class="inputs" type="file" accept="image/*" name="arquivo" id="arquivo" required><br>
          <span style='font-size: smaller; color: red;'><?php echo $errorArquivo; ?></span>
          <select class="inputs" name="tipos" id="tipos" required><br>
            <option value="" selected disabled>Categoría</option>
            <option value="aves">Aves</option>
            <option value="mamiferos">Mamíferos</option>
            <option value="peixes">Peixes</option>
          </select><br>
          <span style='font-size: smaller; color: red;'><?php echo $errorTipos; ?></span>
          <input class="inputs" name="caracteristica1" id="caracteristica1" type="text" placeholder="(característica 1)" required><br>
          <span style='font-size: smaller; color: red;'><?php echo $errorCaracteristica1; ?></span>
          <input class="input-ult" name="caracteristica2" id="caracteristica2" type="text" placeholder="(característica 2)" required>
          <span style='font-size: smaller; color: red;'><?php echo $errorCaracteristica2; ?></span>
      </fieldset>
      <input class="boton" type="submit" value="Guardar">
      </form>
    </div>
    <div>
      <h1>Mamíferos</h1>
      <div class="mamiferos">
        <?php
        // Muestra los mamíferos existentes
        foreach ($animales->listarAnimaisCategoria('mamiferos') as $mamifero) {
          $nombre = $mamifero->nome;
          $nombreLatin = $mamifero->nomeLatin;
          $imagen = $mamifero->arquivo;
          $destino = "arquivos/$imagen";
        ?>
          <div class="mamifero">
          <a href="ficha.php?id=<?php echo $mamifero->id; ?>">
            <img alt="Foto de Perfil" width="64" height="64" src="<?php echo $destino; ?>">
            <p class="nombreLatin"><?php echo $nombreLatin; ?></p>
          </a>  
          </div>
        <?php
        }
        ?>
      </div>
    </div>
    <div>
      <h1>Aves</h1>
      <div class="aves">
        <?php
        // Muestra las aves existentes
        foreach ($animales->listarAnimaisCategoria('aves') as $ave) {
          $nombre = $ave->nome;
          $nombreLatin = $ave->nomeLatin;
          $imagen = $ave->arquivo;
          $destino = "arquivos/$imagen";
        ?>
          <div class="ave">
          <a href="ficha.php?id=<?php echo $ave->id; ?>">
            <img alt="Foto de Perfil" width="64" height="64" src="<?php echo $destino; ?>">
            <p class="nombreLatin"><?php echo $nombreLatin; ?></p>
          </a>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
    <div>
      <h1>Peixes</h1>
      <div class="peixes">
        <?php
        // Muestra los peces existentes
        foreach ($animales->listarAnimaisCategoria('peixes') as $peixe) {
          $nombre = $peixe->nome;
          $nombreLatin = $peixe->nomeLatin;
          $imagen = $peixe->arquivo;
          $destino = "arquivos/$imagen";
        ?>
          <div class="peixe">
          <a href="ficha.php?id=<?php echo $peixe->id; ?>">
            <img alt="Foto de Perfil" width="64" height="64" src="<?php echo $destino; ?>">
            <p class="nombreLatin"><?php echo $nombreLatin; ?></p>
          </a>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

</body>

</html>