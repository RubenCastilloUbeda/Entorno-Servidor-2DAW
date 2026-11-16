<?php
declare(strict_types=1);
require_once __DIR__ . '/preguntas.php';

// TODO: validar sesión y opción, registrar un solo acierto y avanzar.
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); 
    exit;
}

$opcion = filter_var($_POST['respuesta'],FILTER_VALIDATE_INT);

if ($opcion === $preguntas[$_SESSION['preguntaActual']]['correcta']) {
    $_SESSION['aciertos']++;
    $_SESSION['preguntaActual']++;
}

// TODO: redirigir a index.php sin generar HTML.
header('Location:index.php');
exit;
