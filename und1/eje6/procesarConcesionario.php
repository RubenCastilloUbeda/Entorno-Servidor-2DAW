<?php
require_once __DIR__ . '/componentes.php'; // Datos iniciales de opciones, precios y descuentos.

// EJERCICIO 06.
// TODO 1: comprueba el método POST y valida las cinco opciones obligatorias.
// TODO 2: recoge los accesorios seleccionados (pueden ser cero) y la cantidad (1–5).
// TODO 3: calcula el precio unitario SIN IVA a partir de los precios proporcionados.
// TODO 4: multiplica por el número de vehículos y aplica el descuento, si es válido.
// TODO 5: calcula un IVA del 21 % sobre la base una vez descontada la rebaja.
// TODO 6: genera un resumen con opciones, importes, descuentos, IVA y total.
// Si el código de descuento no existe, indica que es inválido y no apliques rebaja.

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    exit('Envía el formulario mediante POST.');
}

$modelo = $_POST["Modelo"] ?? "";
if (!array_key_exists($modelo, $componentes["Modelo"])) {
    exit("No has seleccionado ninguna opcion valida.");
}

$motor = $_POST["Motor"] ?? "";
if (!array_key_exists($motor, $componentes["Motor"])) {
    exit ("No has seleccionado ninguna opcion valida.");
}

$color = $_POST["Color"] ?? "";
if (!array_key_exists($color, $componentes["Color"])) {
    exit ("No has seleccionado ninguna opcion valida.");
}

$llantas = $_POST["Llantas"] ?? "";
if (!array_key_exists($llantas, $componentes["Llantas"])) {
    exit ("No has seleccionado ninguna opcion valida.");
}

$equipamiento = $_POST["Equipamiento"] ?? "";
if (!array_key_exists($equipamiento, $componentes["Equipamiento"])) {
    exit ("No has seleccionado ninguna opcion valida.");
}

$accesorios = $_POST["Accesorios"] ?? [];
if ($accesorios == []) {
    echo "Ningun accesorio seleccionado";
} else {
    foreach ($accesorios as $accesorio) {
        if (!array_key_exists($accesorio, $componentes["Accesorios"])) {
            echo "No has seleccionado ningun accesorio valido.";
        }
    }
}

$cantidad = $_POST["cantidad"] ?? "";
if ($cantidad <= 0 || $cantidad > 5) {
    exit ("Debes indicar una cantidad entre 1 y 5");
}

$codigoDescuento = $_POST["codigo_descuento"] ?? "";
if ($codigoDescuento == "") {
    echo "No utilizaste ningun codigo de descuento";
} else {
    if (!array_key_exists($codigoDescuento, $codigosDescuento)) {
        exit ("No has seleccionado un codigo de descuento valido.");
    } else {
        $cantidadDescuento = $codigosDescuento[$codigoDescuento];
    }
}

$precioTotal = 0;
$IVA = 0.21;

// Forma facil de hacerlo con cada componente de 1 en 1
// $valorModelo=$componentes["Modelo"][$modelo];
// echo $valorModelo;

$clavesComponentes = array_keys($componentes);
$eleccionesUsuario = [$modelo, $motor, $color, $llantas, $equipamiento];

for ($i = 0; $i < count($eleccionesUsuario); $i++) {
    $clave = $clavesComponentes[$i];
    $eleccion = $eleccionesUsuario[$i];

    $precioTotal += $componentes[$clave][$eleccion];
}

foreach ($accesorios as $accesorio) {
    $precioTotal += $componentes["Accesorios"][$accesorio];
}

if ($codigoDescuento != "") {
    $descuento = ($precioTotal * $cantidad) * ($cantidadDescuento / 100);
    $precioTotalFinal = ($precioTotal * $cantidad) - $descuento;
} else {
    $precioTotalFinal = $precioTotal;
}

$precioTotalIva = $precioTotalFinal + ($precioTotalFinal * $IVA);
/* ========================= HTML ================================ */

// echo '<!DOCTYPE html>';
// echo '<html lang="es">';
// echo '<head>';
// echo     '<meta charset="UTF-8">';
// echo     '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
// echo     '<title>Concesionario PHP</title>';
// echo '</head>';
// echo '<body>';
// echo    '<h1>' . "Presupuesto de tu coche " . '</h1>';
// echo    '<h3>' . "Modelo: " . $modelo . '</h3>';
// echo    '<h3>' . "Motor: " . $motor . '</h3>';
// echo    '<h3>' . "Color: " . $color . '</h3>';
// echo    '<h3>' . "Llantas: " . $llantas . '</h3>';
// echo    '<h3>' . "Equipamiento: " . $equipamiento . '</h3>';
// echo    '<h3>' . "Accesorios seleccionados: " . '</h3>';
// foreach ($accesorios as $accesorio) {
//     echo '<li>' . $accesorio . '</li>';
// }
// echo    '<h3>' . "Codigo de descuento: " . '</h3>';
// echo '<div>' . $codigoDescuento . '</div>';
// echo    '<h3>' . "Precio total sin descuento = " . $precioTotal . "€" . '</h3>';
// echo    '<h3>' . "Precio total con descuento = " . $precioTotalFinal . "€" . '</h3>';
// echo    '<h3>' . "Precio total con descuento + IVA = " . $precioTotalIva . "€" . '</h3>';
// echo '</body>';
// echo '</html>';


echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presupuesto del vehículo</title>

    <style>
        body {
            background: #f1f5f9;
            margin: 0;
            padding: 30px;
            color: #1e293b;
        }

        .presupuesto {
            max-width: 850px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px #00000015;
        }

        h1 {
            background: #202e40;
            color: white;
            padding: 20px;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #e2e8f0;
        }

        .tituloPrecio {
            text-align: right;
        }

        .precio {
            color: red;
            text-align: right;
        }

        .total {
            background: #ecfdf5;
            padding: 18px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .total h2 {
            margin-bottom: 0;
            color: #047857;
        }
    </style>
</head>
<body>
<div class="presupuesto">
    <h1>Presupuesto de tu coche</h1>
';
echo '<table>';
echo    '<tr><th>Componente</th><th>Elección</th>
    <th class="tituloPrecio">Precio</th></tr>';

for ($i = 0; $i < count($eleccionesUsuario); $i++) {
    $clave = $clavesComponentes[$i];
    $eleccion = $eleccionesUsuario[$i];
    $precio = $componentes[$clave][$eleccion];

    echo '<tr>';
    echo '<td>' . htmlspecialchars($clave) . '</td>';
    echo '<td>' . htmlspecialchars($eleccion) . '</td>';
    echo '<td class="precio">' .
        number_format($precio, 2, ',', '.') . ' €</td>';
    echo '</tr>';
}
echo '</table>';
echo '<h2>Accesorios seleccionados</h2>';

if (empty($accesorios)) {
    echo '<p>No has seleccionado accesorios.</p>';
} else {
    echo '<table>';
    echo '<tr><th>Accesorio</th>
        <th class="tituloPrecio">Precio</th></tr>';

    foreach ($accesorios as $accesorio) {
        $precio = $componentes["Accesorios"][$accesorio];

        echo '<tr>';
        echo '<td>' . htmlspecialchars($accesorio) . '</td>';
        echo '<td class="precio">' . number_format($precio, 2, ',', '.') . ' €</td>';
        echo '</tr>';
    }
    echo '</table>';
}
echo '<div class="total">';
echo '<p>Precio por vehículo: ' . number_format($precioTotal, 2, ',', '.') . ' €</p>';
echo '<p>Cantidad: ' . (int)$cantidad . '</p>';
echo '<p>Total sin descuento: ' . number_format($precioTotal * $cantidad, 2, ',', '.') . ' €</p>';
echo '<p>Total con descuento: ' . number_format($precioTotalFinal, 2, ',', '.') . ' €</p>';
echo '<h2>Total con IVA: ' . number_format($precioTotalIva, 2, ',', '.') . ' €</h2>';
echo '</div>
</div>
</body>
</html>';
