<?php
/* Comprobar si el metodo es POST o GET
    Recoger datos del formulario y comprobar que los muestra
    Despues aplicar restricciones a los datos del formulario
    Hacer calculos del ejercicio
*/

function mostrar($valor): string {
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    exit('Envía el formulario mediante POST.');
}

$nombre = trim((string) ($_POST["nombre"] ?? ""));
if ($nombre == "") {
    exit("Campo nombre obligatorio");
} elseif (mb_strlen($nombre,"UTF-8")>20) {
    exit("Nombre debe tener como maximo 20 caracteres.");
}

$edad = filter_var( $_POST["edad"] ?? null, FILTER_VALIDATE_INT, ['opciones' => ['minimo' => 0, 'maximo' => 130]]);
if ($edad == false) {
    exit("La edad debe ser entre 0 y 130");
}

$altura = filter_var($_POST["altura"] ?? null, FILTER_VALIDATE_INT, ['opciones' => ['minimo'=> 50, 'maximo' => 300]]);
if ($altura == false) {
    exit("La altura debe ser entre 50 y 300 en cm");
}

$peso = filter_var($_POST["peso"] ?? null, FILTER_VALIDATE_FLOAT, ['opciones' => ['minimo' => 20, 'maximo'=> 500]]);
if ($peso== false) {
    exit("El peso debe estar entre 20 y 500");
}

$alturaMetros=$altura/100;
$pulsacionesMaximas=220;
$IMC=round($peso/($alturaMetros * $alturaMetros),2); 
$pulsaciones= $pulsacionesMaximas-$edad;

echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
echo     '<meta charset="UTF-8">';
echo     '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo     '<title>Document</title>';
echo '</head>';
echo '<body>';
echo    '<h1>' . "Nombre del usuario: " . mostrar($nombre) .'</h1>';
echo '<p>' . "IMC calculado: ". mostrar($IMC) . '</p>';
echo '<p>' . "Estimación de pulsaciones (220 - edad): ". $pulsaciones . '</p>';
echo '</body>';
echo '</html>';