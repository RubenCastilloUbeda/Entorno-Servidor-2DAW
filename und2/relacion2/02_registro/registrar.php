<?php
declare(strict_types=1);
require_once __DIR__ . '/sesion.php';
// TODO: admitir solo POST y comprobar la sesión vigente.

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
    }

    comprobarSesion();

// TODO: validar 'entrada' o 'salida' y respetar su alternancia.

// Recoger y validar el tipo
$tipo = $_POST['tipo'] ?? '';

if (!is_string($tipo) || !in_array($tipo, ['entrada', 'salida'], true)) {
    exit('Tipo de movimiento no válido.');
}

// Recuperar los movimientos
$movimientos = $_SESSION['movimientos'] ?? [];

// Comprobar cuál es el último movimiento
$ultimo = end($movimientos);

// Si no hay movimientos, el primero debe ser entrada
if (empty($movimientos) && $tipo !== 'entrada') {
    exit('El primer movimiento debe ser una entrada.');
}

// Si ya hay movimientos, no se puede repetir el mismo tipo
if (!empty($movimientos) && $ultimo['tipo'] === $tipo) {
    exit('No puedes registrar dos movimientos iguales seguidos.');
}

// TODO: guardar fecha y hora del servidor; redirigir al panel.

$_SESSION['movimientos'][] = [
    'tipo' => $tipo,
    'hora' => time()
];

header('Location: panel.php');
exit;


