<?php


declare(strict_types=1);
require_once __DIR__ . '/incidencias.php';

// TODO: recuperar incidencias revisadas.


// TODO: iniciar sesión, comprobar acceso 
session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: login.php');
    exit;
}










?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Panel</title>
</head>

<body>
    <h1>Incidencias del centro</h1>
    <!-- TODO: saludo, estado de incidencias y botones POST para revisar. -->
    <h2>Hola <?= $_SESSION["nombre"] ?></h2>
    <h2>Perfil: <?= $_SESSION["perfil"] ?></h2>
    
    <!-- TODO: enlace al informe y formulario POST de cierre de sesión. -->
    <form action="logout.php" method="post">
        <button type="submit">Cerrar sesión</button>
    </form>
</body>

</html>