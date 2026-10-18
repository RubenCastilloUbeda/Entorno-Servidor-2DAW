<?php
require_once __DIR__ . '/repositorioPreguntas.php';

// EJERCICIO 07 - PARTE A: GENERACIÓN.
// TODO 1: exige POST y valida asignatura y numeroDePreguntas (entre 1 y 5).
// TODO 2: elige al azar preguntas distintas del repositorio de esa asignatura.
// TODO 3: genera un formulario HTML POST dirigido a comprobarTest.php.
// TODO 4: incluye identificadores de preguntas y opciones de respuesta
//          (radios) para que el corrector pueda cotejar las respuestas.
// TODO 5: incorpora información suficiente para conocer qué asignatura
//          y qué preguntas se han mostrado, sin enviar al cliente las soluciones.

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    exit('Envía el formulario mediante POST.');
}

$asignatura = $_POST["asignatura"] ?? "" ;

$numeroPreguntas = $_POST["numeroDePreguntas"] ?? "";
if ($numeroPreguntas <= 0 || $numeroPreguntas > 5) {
    exit ("Debes indicar un número entre 1 y 5");
}

/* con (array) delante le digo que siempre me devuelva un tipo array, sea 1 elemento o varios. Evita fallo count($array)*/
$preguntasAleatorias = (array) array_rand($repositorioPreguntas[$asignatura], $numeroPreguntas);



echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador Tests</title>
</head>
<body>
    <h1> Preguntas aleatorias </h1>
    <form action="comprobarTest.php" method="POST">
<div>';
for ($i=0; $i < count($preguntasAleatorias); $i++) { 
    $pregunta=$preguntasAleatorias[$i];
    $posiblesRespuestas = $repositorioPreguntas[$asignatura][$preguntasAleatorias[$i]];
    $respuesta1= $posiblesRespuestas[0];
    $respuesta2= $posiblesRespuestas[1];
    $respuesta3= $posiblesRespuestas[2];

echo $pregunta;
echo '</div>
<fieldset>
    <label for="respuesta"></label>
    <label for="respuesta">' . $respuesta1 . '</label>
    <input type="radio" name="respuestas[' . $i . ']" value="' . htmlspecialchars($respuesta1, ENT_QUOTES, 'UTF-8') . '">    
    <label for="respuesta">' . $respuesta2 . '</label>
    <input type="radio" name="respuestas[' . $i . ']" value="' . htmlspecialchars($respuesta2, ENT_QUOTES, 'UTF-8') . '">
    <label for="respuesta">' . $respuesta3 . '</label>
    <input type="radio" name="respuestas[' . $i . ']" value="' . htmlspecialchars($respuesta3, ENT_QUOTES, 'UTF-8') . '">
</fieldset>';
}
echo '<button type="submit">Corregir test</button>
</form>
</body>
</html>';

