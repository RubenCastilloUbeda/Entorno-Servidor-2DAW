<?php
require_once __DIR__ . '/horario.php'; // Datos de días, tramos horarios y asignaturas.

// EJERCICIO 05.
// TODO 1: acepta únicamente POST; recupera y valida asignaturas[].
// TODO 2: para cada asignatura elegida, muestra sus días e intervalos de clase.
// TODO 3: suma la duración semanal de TODOS sus intervalos (hay días con dos tramos).
// TODO 4 (ampliación): genera una tabla de lunes a viernes y colorea las celdas
//    de los tramos que correspondan a las asignaturas seleccionadas.
// En horario.php están los datos iniciales; la lógica debes escribirla aquí.

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    exit('Envía el formulario mediante POST.');
}

function mostrar($valor): string {
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$asignaturasValidas = ["Ingles","DAW","DIW", "DWEC", "DWES", "IPE_II", "Proyecto","Optativa"];

$asignaturas = $_POST['asignaturas'] ?? []; /* [] significa que llega vacio / cuando es un array no se pone el nombre del name del html con []*/
foreach ($asignaturas as $asignatura) {
    if (!in_array($asignatura, $asignaturasValidas, true)) {
        exit("Asignatura no valida.");
    }
}
echo 'Pendiente de implementar el ejercicio 05.';
echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
echo     '<meta charset="UTF-8">';
echo     '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo     '<title>Document</title>';
echo '</head>';
echo '<body>';
echo    '<h1>' . "Asignaturas -> " . '</h1>';
echo    '<ul>';
    foreach($asignaturas as $asignatura) {
        echo '<li>' . mostrar($asignatura) . '</li>';
        echo '<br>';
    };
    if (!$asignaturas) {
        echo '<li>Ninguna seleccionada</li>';
    }
echo    '</ul>';
echo '</body>';
echo '</html>';