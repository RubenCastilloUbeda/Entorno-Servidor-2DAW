<?php

declare(strict_types=1);
require_once __DIR__ . '/incidencias.php';

// TODO: iniciar sesión, comprobar autenticación y perfil coordinacion.
session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: login.php');
    exit;
    }

// TODO: devolver 403 si el perfil no tiene permiso.
if (($_SESSION['perfil']) !== 'coordinacion') {
    http_response_code(403);
    exit;
} else {
    $totalIncidencias = count($incidencias);
    $totalRevisadas = count($_SESSION['revisadas'] ?? []);
    $totalPendientes = $totalIncidencias - $totalRevisadas;
}

// TODO: calcular revisadas y pendientes.

?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Informe</title>
</head>

<body>
    <h1>Informe de incidencias</h1>

    <p>Total de incidencias: <?= $totalIncidencias ?></p>
    <p>Incidencias revisadas: <?= $totalRevisadas ?></p>
    <p>Incidencias pendientes: <?= $totalPendientes ?></p>

    <p><a href="panel.php">Volver al panel</a></p>
</body>

</html>
