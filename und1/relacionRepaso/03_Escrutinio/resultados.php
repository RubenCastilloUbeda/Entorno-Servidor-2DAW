<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resultado del escrutinio</title>
</head>

<body>
    <h1>Resultado ficticio del escrutinio</h1>
    <!-- TODO: tabla de partidos por votos (descendente) y porcentaje sobre válidos. -->
    <!-- TODO: censo, emitidos, válidos, nulos, blancos, abstención y participación. -->
    <!-- TODO: ganador o empate; número de partidos que alcanzan el 5 %. -->

    <h2>Censo - <?= mostrar($censo) ?> </h2>
    <?php if ($votosEmitidos>$censo): ?>
    <p>Los votos emitidos son mayores que el censo total.</p>
    <?php else: ?>
    <p> Votos emitidos: <?= (int)$votosEmitidos ?></p>
    <?php endif; ?>

    <table border="1">
    <tr>
        <th>Partido</th>
        <th>Numero Votos</th>
        <th> % de votos </th>
    </tr>

    <?php foreach ($votos as $partido => $cantidadVotos): ?>
        <tr>
            <td><?= mostrar($partido) ?></td>
            <td><?= (int)$cantidadVotos ?> </td>
            <td><?= number_format($porcentajes[$partido] = ($cantidadVotos / $votosValidos) * 100,2,',','.');?> % </td>
        </tr>
    <?php endforeach; ?>
        <tr>
            <td>Votos en blanco</td>
            <td><?= (int)$votosBlanco ?></td>
        </tr>
        <tr>
            <td>Votos nulos</td>
            <td><?= (int)$votosNulos ?></td>
        </tr>
        <tr>
            <td>Abstencion</td>
            <td> <?= (int)$abstencion ?></td>
        </tr>
</table>

    <p><a href="escrutinio.html">Nuevo recuento</a></p>
</body>

</html>