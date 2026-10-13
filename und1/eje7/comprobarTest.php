<?php
require_once __DIR__ . '/repositorioPreguntas.php';
require_once __DIR__ . '/generadorDeTests.php';


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
$pregunta = $_POST["pregunta"] ?? "" ;
$respuesta = $_POST["respuesta"] ?? "" ;



'<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>';
    echo $respuesta;
    echo $pregunta;
    echo $asignatura;
'</body>
</html>';