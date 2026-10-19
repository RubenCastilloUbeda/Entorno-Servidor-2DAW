<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Informe del pacto</title>
</head>

<body>
    <h1>Informe del pacto (simulación)</h1>

    <h2>Datos de la Asamblea</h2>

    <p>Asamblea: <?= escapar($escenarios[$escenario]['nombre']) ?></p>
    <p>Total de escaños: <?= $totalEscanos ?></p>
    <p>Mayoría absoluta: <?= $mayoria ?></p>

    <h2>Partidos del pacto</h2>

    <ul>
        <?php foreach ($partidosSeleccionados as $partido): ?>
            <li><?= escapar($partido) ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Resultado del pacto</h2>

    <p>Escaños del pacto: <?= $sumarEscanos ?></p>

    <?php if ($sumarEscanos >= $mayoria): ?>
        <p>El pacto alcanza la mayoría absoluta.</p>
        <p>Supera o iguala la mayoría por <?= $sumarEscanos - $mayoria ?> escaños.</p>
    <?php else: ?>
        <p>El pacto no alcanza la mayoría absoluta.</p>
        <p>Le faltan <?= $mayoria - $sumarEscanos ?> escaños.</p>
    <?php endif; ?>

    <h2>Posibles socios adicionales</h2>

    <table border="1">
        <tr>
            <th>Partido que se une</th>
            <th>Escaños totales</th>
            <th>¿Alcanza mayoría?</th>
        </tr>

        <?php foreach ($posiblesPactos as $partido => $datos): ?>
            <tr>
                <td><?= escapar($partido) ?></td>
                <td><?= $datos['escanos'] ?></td>
                <td><?= $datos['mayoria'] ? 'Sí' : 'No' ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Mejor socio adicional</h2>

    <p><?= escapar($mensaje) ?></p>

    <p><a href="pactos.html">Analizar otro pacto</a></p>
</body>

</html>