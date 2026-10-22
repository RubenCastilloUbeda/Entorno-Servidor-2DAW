<?php
// He preparado los datos en catalogo.php; utilízalos mediante sus variables.
require_once __DIR__ . '/catalogo.php';

function mostrar($dato)
{
    echo htmlspecialchars((string) $dato, ENT_QUOTES, 'UTF-8');
}

// TODO 1. Asegurarte de que la petición llega por POST.
// TODO 2. Validar nombre, franja y gatos[] (gatos reales, sin repetidos,
//         cantidad permitida por $normasVisita).
// TODO 3. Separar gatos disponibles y no disponibles para la franja.
// TODO 4. Preparar la información que se mostrará en el HTML.
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

$gatosSeleccionados = $_POST['gatos'] ?? [];
if (!is_array($gatosSeleccionados) || empty($gatosSeleccionados)) {
    exit('Gatos no válidos.');
}


$gatosDisponibles = [];
$gatosNoDisponibles = [];


foreach ($gatosSeleccionados as $gato) {
    if ($gatos[$gato]['disponibilidad'][$turno]) {
        array_push($gatosDisponibles, $gato);
    } else {
        array_push($gatosNoDisponibles, $gato);
    }
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>PT1-Int2 - Preparar visita</title>
</head>

<body>
    <h1>Propuesta de visita</h1>
    <p>Nombre: <?= mostrar($nombre) ?></p>
    <p>Turno:<?= mostrar($turno) ?> : <?= mostrar($normasVisita['horas_inicio'][$turno]) ?></p>


    <h1>Gatos Disponibles</h1>

    <form action="confirmarVisita.php" method="POST">
        <input type="hidden" name="nombre" value="<?= mostrar($nombre) ?>">
        <input type="hidden" name="franja" value="<?= mostrar($turno) ?>">

        <ul> <?php if (empty($gatosDisponibles)): ?>
                <p>No hay gatos disponibles de los seleccionados.</p>
            <?php else: ?>
                <?php foreach ($gatosDisponibles as $gato): ?>
                    <input type="hidden" name="gatosDisponibles[]" value="<?= mostrar($gato) ?>">
                    <li><?= mostrar($gatos[$gato]['nombre']) ?> : <?= mostrar($gatos[$gato]['edad']) ?> años, <?= mostrar($gatos[$gato]['caracter']) ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>

        <h1>Gatos No Disponibles</h1>
        <ul> <?php if (empty($gatosNoDisponibles)): ?>
                <p>No hay gatos no disponibles de los seleccionados.</p>
            <?php else: ?>
                <?php foreach ($gatosNoDisponibles as $gato): ?>
                    <li><?= mostrar($gatos[$gato]['nombre']) ?> : <?= mostrar($gatos[$gato]['edad']) ?> años, <?= mostrar($gatos[$gato]['caracter']) ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>

        <h2>Confirmar visita a gatos disponibles</h2>

        <?php foreach ($gatosDisponibles as $gato): ?>
            <fieldset>
                <legend><?= mostrar($gatos[$gato]['nombre']) ?></legend>
                <label><input type="checkbox" name="confirmados[]" value="<?= mostrar($gato) ?>"> Confirmar</label>
                <label>Cuidador:
                    <select name="cuidadores[<?= mostrar($gato) ?>]">
                        <?php foreach ($cuidadores as $cuidador => $datosCuidador): ?>
                            <option value="<?= mostrar($cuidador) ?>"><?= mostrar($datosCuidador['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </fieldset>
        <?php endforeach; ?>
        <button type="submit">Confirmar visita</button>
    </form>
    <!-- TODO: Crear con bucles un formulario POST hacia confirmarVisita.php. -->
    <!--       Para cada gato disponible, añadir una casilla confirmados[] -->
    <!--       y un desplegable de cuidadores con name="cuidadores[gato_GATO]". -->
    <!-- TODO: Conservar nombre, franja y TODOS los solicitados[] mediante hidden. -->
    <!-- TODO: Permitir confirmar entre 1 y 3 gatos disponibles. -->
</body>

</html>