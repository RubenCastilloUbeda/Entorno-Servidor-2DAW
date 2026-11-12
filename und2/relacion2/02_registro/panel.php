<?php

declare(strict_types=1);
require_once __DIR__ . '/sesion.php';
// TODO: comprobar la sesión vigente y recuperar los movimientos.

function formatearHora($hora)
{
    return date('H:i:s', $hora);
}

comprobarSesion();

// Guardar los movimientos en variable para usarla
$movimientos = $_SESSION['movimientos'] ?? [];

?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Mi turno</title>
</head>

<body>
    <h1>Registro de turnos</h1>
    <h2>Sesion de <?= $_SESSION['nombre'] ?? " ### " ?></h2>
    <!-- TODO: tabla de movimientos, botones Entrada/Salida y formulario Salir. -->
    <table border="1">
        <tr>
            <th>Tipo</th>
            <th>Fecha y hora</th>
        </tr>

        <?php foreach ($movimientos as $movimiento): ?>
            <tr>
                <td>
                    <?= htmlspecialchars($movimiento['tipo']) ?>
                </td>
                <td>
                    <?= formatearHora($movimiento['hora']) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Registrar movimiento</h3>

    <form action="registrar.php" method="post">
        <input type="hidden" name="tipo" value="entrada">
        <button type="submit">Entrada</button>
    </form>

    <form action="registrar.php" method="post">
        <input type="hidden" name="tipo" value="salida">
        <button type="submit">Salida</button>
    </form>

    <h3>Cerrar sesión</h3>

    <form action="salir.php" method="post">
        <button type="submit">Cerrar sesión</button>
    </form>

</body>

</html>