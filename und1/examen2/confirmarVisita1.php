<?php
// He preparado los datos en catalogo.php; utilízalos mediante sus variables.
require_once __DIR__ . '/catalogo.php';

function mostrar($dato)
{
    echo htmlspecialchars((string) $dato, ENT_QUOTES, 'UTF-8');
}

// TODO 1. Comprobar POST y validar nombre, franja, solicitados[],
//         confirmados[] y cuidadores[]; no confiar en los hidden.
// TODO 2. Comprobar que cada confirmado existe, fue solicitado,
//         está disponible y tiene un cuidador válido asignado.
// TODO 3. Consultar $cuidadores para saber si el gato confía en
//         el cuidador elegido y usar la duración correspondiente.
// TODO 4. Calcular las horas consecutivas desde $normasVisita.
// TODO 5. Preparar la información del justificante o los errores.
// Las funciones auxiliares deben DEVOLVER resultados y no imprimir.

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    exit('Envía el formulario mediante POST.');
}

$nombre = $_POST['nombre'] ?? '';
if (!is_string($nombre) || trim($nombre) === '') {
    exit('Nombre no válido.');
}

$turno = $_POST['franja'] ?? '';
if (!is_string($turno) || trim($turno) === '') {
    exit('Turno no válido.');
}

$confirmados = $_POST['confirmados'] ?? [];
$cuidadores = $_POST['cuidadores'] ?? [];







?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>PT1-Int2 - Confirmar visita</title>
</head>

<body>
    <h1>Justificante de visita</h1>
    <p>Nombre: <?= mostrar($nombre) ?></p>
    <p>Turno:<?= mostrar($turno) ?> - <?= mostrar($normasVisita['horas_inicio'][$turno]) ?></p>

    <table border="1">
        <tr>
            <th>Gato</th>
            <th>Cuidador</th>
            <th>Comportamiento</th>
            <th>Hora de inicio</th>
            <th>Duracion</th>
        </tr>

        <?php foreach ($confirmados as $gato => $cuidador): ?>
            <tr>
                <td><?= mostrar($gatos[$gato]['nombre']) ?></td>
                <td>
                    <?php if ($cuidador==in_array($cuidadores[$gato],$cuidadores[$gato]['gatos_confiados'])): ?>
                        <p>No has seleccionado ningún complemento.</p>
                    <?php else: ?>
                        <?php foreach ($complementos as $extra): ?>
                            <p><?= htmlspecialchars($extras[$extra]['nombre']) ?></p>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>

    <!-- TODO: Si hay errores, mostrarlos sin emitir un justificante válido. -->
    <!-- TODO: Mostrar nombre, turno y tabla con gato, cuidador, -->
    <!--       comportamiento (tranquilo / nervioso), hora y duración. -->
    <!-- TODO: Mostrar número de gatos y duración total. -->
    <!-- TODO: Informar de que la visita es simulada y enlazar a index.html. -->
</body>

</html>