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

$modelo=$_POST["Modelo"] ?? "";
if (!array_key_exists($modelo,$componentes["Modelo"])) {
    echo "No has seleccionado ninguna opcion valida.";
}

$motor=$_POST["Motor"] ?? "";
if (!array_key_exists($motor,$componentes["Motor"])) {
    echo "No has seleccionado ninguna opcion valida.";
}

$color=$_POST["Color"] ?? "";
if (!array_key_exists($color,$componentes["Color"])) {
    echo "No has seleccionado ninguna opcion valida.";
}

$llantas=$_POST["Llantas"] ?? "";
if (!array_key_exists($llantas,$componentes["Llantas"])) {
    echo "No has seleccionado ninguna opcion valida.";
}

$equipamiento=$_POST["Equipamiento"] ?? "";
if (!array_key_exists($equipamiento,$componentes["Equipamiento"])) {
    echo "No has seleccionado ninguna opcion valida.";
}

$accesorios=$_POST["Accesorios"] ?? [];
if (!array_key_exists($equipamiento,$componentes["Accesorios"])) {
    echo "No has seleccionado ningun accesorio valido.";
} else {
    echo "Ningun accesorio seleccionado.";
}

$cantidad=$_POST["cantidad"] ?? "";
if ($cantidad <= 0 || $cantidad >= 5) {
    echo "Debes indicar una cantidad entre 1 y 5";
}

$codigoDescuento=$_POS["codigo_descuento"] ?? "";
if (!array_key_exists($codigoDescuento,$codigosDescuento)) {
    $codigoDescuento= "No has seleccionado un codigo de descuento valido.";
} else {
    $codigoDescuento ="No utilizaste ningun codigo de descuento";
}

$precioTotal=0;

$valorModelo=$componentes["Modelo"][$modelo];
echo $valorModelo;


/* ========================= HTML ================================ */

echo '<!DOCTYPE html>';
echo '<html lang="es">';
echo '<head>';
echo     '<meta charset="UTF-8">';
echo     '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo     '<title>Concesionario PHP</title>';
echo '</head>';
echo '<body>';
echo    '<h1>' . "Presupuesto de tu coche " . '</h1>';
echo    '<h3>' . "Modelo: " . $modelo . '</h3>';
echo    '<h3>' . "Motor: " . $motor . '</h3>';
echo    '<h3>' . "Color: " . $color . '</h3>';
echo    '<h3>' . "Llantas: " . $llantas . '</h3>';
echo    '<h3>' . "Equipamiento: " . $equipamiento . '</h3>';
echo    '<h3>' . "Accesorios seleccionados: " . '</h3>';
    foreach ($accesorios as $accesorio) {
        echo '<li>'. $accesorio .'</li>';
    }
echo    '<h3>' . "Codigo de descuento: " . '</h3>';
echo '<div>' . $codigoDescuento . '</div>';
echo '</body>';
echo '</html>';
