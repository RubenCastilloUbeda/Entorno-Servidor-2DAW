<?php
/* Primero: comprobar metodo POST o GET 
    Segundo: recoger datos del formulario y guardarlo en las variables
    Tercero: hacer comprobaciones de cada una de las variables
    Cuarto:hacer variables con arrays de los datos que debe tener el formulario (para evitar hackeos es una buena práctica)
    Quinto:crear el html pero dentro de la etiqueta <?php mostrando los resultados con echo 
    Buena práctica crear funciones que hagan comprobaciones */

function mostrar($valor): string {
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    exit('Envía el formulario mediante POST.');
}

$nombre = trim((string) ($_POST['nombre'] ?? ''));
$apellidos = trim((string) ($_POST['apellidos'] ?? ''));
$edad = $_POST["edad"];
$peso = $_POST["peso"] ;
$sexo = $_POST["sexo"];
$estadoCivil = $_POST["estado-civil"];
$aficiones = $_POST["aficiones"];

echo '<!doctype html>';
echo '<html lang="es">';
echo '<head>';
echo '<meta charset="utf-8">';
echo '<title>Datos personales</title>';
echo '</head>';
echo '<body>';

echo '<h1>'
    . mostrar($nombre) 
    . ' '
    . mostrar($apellidos)
    . '</h1>';

echo '<p>Edad: ' . mostrar($edad) . '</p>';
echo '<p>Peso: ' . mostrar($peso) . ' kg</p>';

echo '<p>Sexo: '
    . mostrar($sexo)
    . '</p>';

echo '<p>Estado civil: '
    . mostrar($estadoCivil)
    . '</p>';

echo '<h2>Aficiones:</h2>';
echo '<ul>';

foreach ($aficiones as $aficion) {
    echo '<li>'
        . mostrar($aficion)
        . '</li>';
}

if (!$aficiones) {
    echo '<li>Ninguna seleccionada</li>';
}

echo '</ul>';
echo '</body>';
echo '</html>';

