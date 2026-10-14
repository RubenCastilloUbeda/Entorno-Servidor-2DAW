<?php
require_once __DIR__ . '/repositorioPreguntas.php';

// EJERCICIO 07 - PARTE B: CORRECCIÓN.
// TODO 1: exige POST y recupera asignatura, preguntas y respuestas.
// TODO 2: comprueba que las preguntas enviadas pertenecen a la asignatura,
//          no están repetidas y que cada respuesta pertenece a sus opciones.
// TODO 3: consulta el mapa de soluciones que has completado en el repositorio.
// TODO 4: cuenta aciertos y fallos (incluidas las preguntas en blanco).
// TODO 5: calcula una nota entre 0 y 10 y muestra el resultado en HTML.

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    exit('Envía el formulario mediante POST.');
}

$asignatura = $_POST["asignatura"] ?? "" ;
$preguntas = $_POST["preguntasAleatorias"] ?? [] ;
$respuestasUsuario = $_POST["respuestas"] ?? [] ;
$respuestasCorrectas=[];

for ($i=0; $i < count($preguntas) ; $i++) { 
    $respuestasCorrectas=$repositorioRespuestas[$asignatura][$preguntas[$i]];
}

echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Resultados del test</h1>';

for ($i = 0; $i < count($preguntas); $i++) {
    echo '<p><strong>Pregunta:</strong> '
        . htmlspecialchars($preguntas[$i], ENT_QUOTES, 'UTF-8')
        . '</p>';

    echo '<p><strong>Tu respuesta:</strong> '
        . htmlspecialchars($respuestasUsuario[$i] ?? 'Sin responder', ENT_QUOTES, 'UTF-8')
        . '</p>';

    echo '<p><strong>Respuesta correcta:</strong> '
        . htmlspecialchars($respuestasCorrectas[$i], ENT_QUOTES, 'UTF-8')
        . '</p>';
}

echo '</body>
</html>';