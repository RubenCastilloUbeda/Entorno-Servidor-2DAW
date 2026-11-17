<?php

declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/EquipoRepositorio.php';

function mostrar(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
// Completa las acciones POST y recupera el listado.

// Crear nuevo repositorio para usar y conectar a la BBDD
$nuevoRepo = new EquipoRepositorio(conectar());

$equipos = $nuevoRepo->listar();

if ($_POST['accion'] ?? '' === 'crear') {
    $nuevoRepo->crear(($_POST['nombre'] ?? ''),($_POST['unidades'] ?? ''),
    );
}




?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Catálogo de equipos</title>
</head>

<body>
    <h1>Catálogo de equipos</h1>
    <!-- Completa la tabla y los formularios. -->
    <h2>Crear usuario</h2>
    <form action="index.php" method="post">
        <input type="hidden" name="accion" value="crear">
        <input name="nombre" placeholder="Nombre" minlength="2" maxlength="80" required>
        <input type="number" name="unidades" min="0" placeholder="Unidades" required>
        <button type="submit">Crear</button>
    </form>
    <h2>Listado</h2>
    <ul>
        <?php foreach ($equipos as $equipo): ?>
            <li>

                <?= mostrar($equipo['nombre']) ?> | Unidades: <?= mostrar((string) $equipo['unidades']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>