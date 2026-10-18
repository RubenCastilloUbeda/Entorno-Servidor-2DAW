<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ticket del pedido</title>
</head>

<body>
    <h1>Ticket de material electoral</h1>
    <table border="1">
        <tr>
            <th>Concepto</th>
            <th>Detalle</th>
        </tr>

        <tr>
            <td>Partido</td>
            <td><?= escapar($partido) ?></td>
        </tr>

        <tr>
            <td>Pack</td>
            <td><?= $packs[$pack]['nombre'] ?></td>
        </tr>

        <tr>
            <td>Unidades</td>
            <td><?= $unidades ?></td>
        </tr>

        <tr>
            <td>Extras</td>
            <td>
                <?php
                if (empty($complementos)) {
                    echo 'Ninguno';
                } else {
                    foreach ($complementos as $extra) {
                        echo $extras[$extra]['nombre'] . '<br>';
                    }
                }
                ?>
            </td>
        </tr>

        <tr>
            <td>Transporte</td>
            <td><?= escapar($transporte) ?></td>
        </tr>

        <tr>
            <td>Subtotal de mercancía</td>
            <td><?= formatearImporte($precioTotalUnidades) ?> </td>
        </tr>

        <tr>
            <td>Descuento</td>
            <td><?= formatearImporte($descuento) ?> </td>
        </tr>

        <tr>
            <td>Transporte</td>
            <td><?= formatearImporte($precioTransporte) ?> </td>
        </tr>

        <tr>
            <td>Base imponible</td>
            <td><?= formatearImporte($base) ?> </td>
        </tr>

        <tr>
            <td>IVA (<?= $ivaPorcentaje ?> %)</td>
            <td><?= formatearImporte($importeIVA) ?> </td>
        </tr>

        <tr>
            <th>Total final</th>
            <th><?= formatearImporte($precioFinal) ?> </th>
        </tr>
    </table>

    <?php if ($superaPresupuesto): ?>
        <p>El pedido supera los 500 €.</p>
    <?php else: ?>
        <p>El pedido no supera los 500 €.</p>
    <?php endif; ?>

    <p><a href="pedido.html">Volver al formulario</a></p>
</body>

</html>
