<?php

    if (isset($_POST["nombre"])) {
        $nombre = $_POST["nombre"];
    } else {
        echo "Nombre obligatorio";
    }
    if (isset($_POST["edad"])) {
        $edad = $_POST["edad"];
    } else {
        echo "Edad obligatoria";
    }

$apellidos = $_POST["apellidos"];
$peso = $_POST["peso"];
$sexo = $_POST["sexo"];
$estadoCivil = $_POST["estado-civil"];
$aficiones = $_POST["aficiones"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?= $nombre?> <?= $apellidos?></h1>
    <div>
        <p>Edad: <?= $edad?></p>
        <p>Sexo: <?= $sexo?></p>
        <p>Peso: <?= $peso?></p>
        <ul>
            <?php  foreach ($aficiones as $aficion) {
                echo "<li> $aficion </li>";
            } 
            ?>
            
        </ul>
    </div>
</body>
</html>
