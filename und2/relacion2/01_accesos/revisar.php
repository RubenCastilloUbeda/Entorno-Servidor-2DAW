<?php
declare(strict_types=1);
require_once __DIR__ . '/incidencias.php';
session_start();

$_SESSION['revisadas'] = $_SESSION['revisadas'] ?? [];

// TODO: permitir solamente POST; comprobar autenticación.

if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    http_response_code(405);
    exit;
}

if (!isset($_SESSION['nombre'])) {
    header('Location: login.php');
    exit;
    }

// TODO: validar el ID frente al catálogo y marcarlo una sola vez.

$identificador = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);

if ($identificador === false || !array_key_exists($identificador, $incidencias)) {
    exit('Identificador de incidencia no válido.');
}

if (!in_array($identificador,$_SESSION['revisadas'],true) ) {
    $_SESSION['revisadas'][] = $identificador;
    }

    // TODO: redirigir al panel.
    header('Location: panel.php');
    exit;