<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Resultados de agenda</title>
    </head>
    <body>
        <h1>Actos encontrados</h1>
        <!-- TODO: mostrar los filtros, el total de coincidencias y el aforo acumulado. -->
        <!-- TODO: tabla con fecha, hora, provincia, partido, tipo, lugar y aforo. -->
        <!-- TODO: si no hay coincidencias, indicar que la búsqueda no tiene resultados. -->
        <p><a href="agenda.html">Nueva búsqueda</a></p>
            <h1>Campaña electoral</h1>
        <table>
            <tr>
                <th>Partido</th>
                <th>Provincia</th>
                <th>Tipo de acto</th>
            </tr>
            <?php foreach ($actosEncontrados as $acto) : ?>
                <tr>
                    <td> <?= mostrar($acto["partido"]) ?> </td>
                    <td> <?= mostrar($acto["provincia"]) ?> </td>
                    <td> <?= mostrar($acto["tipo"]) ?> </td>
                </tr>
            <?php endforeach; ?>
    </body>
</html>
