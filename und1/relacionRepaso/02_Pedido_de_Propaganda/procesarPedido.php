<?php
require_once __DIR__ . '/catalogo.php';
require_once __DIR__ . '/funciones.php';

// TODO 1: aceptar solo POST y validar partido, pack, transporte, unidades (1..8).
// TODO 2: recuperar extras[] (puede no existir), validar sus valores y eliminar duplicados.
// TODO 3: calcular precio unitario = pack + suma de extras.
// TODO 4: mercancía = precio unitario * unidades; aplicar código si es válido.
//          Un código inválido NO da descuento; el transporte NO se descuenta.
// TODO 5: calcular base con transporte, IVA 21 % y total final.
// TODO 6: indicar si total final supera 500 €, y preparar desglose en la vista.


if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    exit('Envía el formulario mediante POST.');
}

$partido = $_POST["partido"] ?? "";
if (!in_array($partido, $partidos)) {
    exit("No has seleccionado ninguna partido valida.");
}

$pack = $_POST["pack"] ?? null;
if (!array_key_exists($pack, $packs)) {
    exit("No has seleccionado ninguna pack valida.");
}

$transporte = $_POST["transporte"] ?? null;
if (!array_key_exists($transporte, $transportes)) {
    exit("No has seleccionado ninguna transporte valida.");
}

$unidades = filter_var($_POST['unidades'] ?? null,
    FILTER_VALIDATE_INT,
    ['options' => ['min_range' => 1, 'max_range' => 8]]
);

$complementos=$_POST["extras"] ?? [];
if ($complementos == []) {
    echo "Ningun extra seleccionado";
} else {
    foreach ($complementos as $extra) {
        if (!array_key_exists($extra, $extras)) {
            echo "No has seleccionado ningun complementos valido.";
        }
    }
}

$codigoDescuento = $_POST["codigo"] ?? "";
if ($codigoDescuento == "") {
    $codigoDescuento = "No utilizaste ningun codigo de descuento";
} else {
    if (!array_key_exists($codigoDescuento, $codigos)) {
        exit ("No has seleccionado un codigo de descuento valido.");
    } else {
        $cantidadDescuento = $codigos[$codigoDescuento];
    }
}

$precioPack=$packs[$pack]["precio"];
$precioExtras=0;
foreach ($complementos as $extra) {
    $precioExtras += $extras[$extra]["precio"];
}
$precioUnitario=$precioExtras+$precioPack;
$precioTotalUnidades=$precioUnitario*$unidades;

// Descuento sobre la mercancía
$cantidadDescuento = $codigos[$codigoDescuento] ?? 0;
$descuento = $precioTotalUnidades * ($cantidadDescuento / 100);
$subtotal = $precioTotalUnidades - $descuento;

// Transporte
$precioTransporte = $transportes[$transporte];

// Base imponible e IVA
$base = $subtotal + $precioTransporte;
$importeIVA = $base * ($ivaPorcentaje / 100);
$precioFinal = $base + $importeIVA;

// Comprobar presupuesto
$superaPresupuesto = $precioFinal > $presupuestoMaximo;

require __DIR__ . '/ticket.php';







