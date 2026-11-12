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
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Aula</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
        <?php foreach ($incidencias as $id => $incidencia): ?>
            <tr>
                <td><?= $id ?></td>
                <td><?= htmlspecialchars($incidencia['aula'])  ?></td>
                <td><?= htmlspecialchars($incidencia['descripcion'])  ?></td>
                <?php if (in_array($id, $_SESSION['revisadas'] ?? [], true)): ?>
                    <td><?= 'Revisada' ?></td>
                    <td> - </td>
                <?php else: ?>
                    <td><?= 'Pendiente' ?></td>
                    <td>
                        <form action="revisar.php" method="post">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <button type="submit">Marcar como revisada</button>
                        </form>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
    <!-- TODO: enlace al informe y formulario POST de cierre de sesión. -->
    <a href="informe.php">Informe</a>

    <form action="logout.php" method="post">
        <button type="submit">Cerrar sesión</button>
    </form>
</body>

</html>