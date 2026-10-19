<?php
require_once __DIR__ . '/datosEscenarios.php';
require_once __DIR__ . '/funciones.php';

// TODO 1: exigir POST, validar escenario y socios[] (array de 1 a 3 partidos).
// TODO 2: rechazar socios repetidos y nombres ajenos a la lista del escenario.
// TODO 3: sumar escaños y calcular mayoría absoluta (mitad + 1).
// TODO 4: indicar mayoría sí/no, y cuántos escaños sobran o faltan.
// TODO 5: para cada partido que NO forme parte del pacto, calcular
//          cuántos escaños tendría la coalición SI se uniera.
//          Marcar cuáles de esas coaliciones alcanzarían la mayoría.
// TODO 6: indicar qué partido fuera del pacto permitiría llegar a
//          la mayoría aportando la MENOR cantidad de escaños.
//          Si el pacto ya tiene mayoría, no se necesita socio adicional.
//          Si ninguno sirve por sí solo, indicarlo.
// TODO 7: construir el informe en vistas/informe.php.

/* recoger datos y validar */
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    exit('Envía el formulario mediante POST.');
}

$escenario=$_POST['escenario'] ?? '';
if (!is_string($escenario) || trim($escenario) === '' || !array_key_exists($escenario, $escenarios)) {
    exit('Escenario no válido.');
}

$partidosSeleccionados= $_POST['socios'] ?? [];
if (!is_array($partidosSeleccionados) || (count($partidosSeleccionados)<1 || count($partidosSeleccionados)>3)) {
    exit('Partidos elegidos no validos.');
}

foreach ($partidosSeleccionados as $partido) {
    if (!is_string($partido) || !in_array($partido, $partidos, true)) {
        exit('Hay un partido no válido.');
    }
}

/* rechazar repetidos */

if (count($partidosSeleccionados) !== count(array_unique($partidosSeleccionados))) {
    exit('No puedes seleccionar partidos repetidos.');
}


/* sumar escaños */
$sumarEscanos=0;

foreach ($escenarios[$escenario]["partidos"] as $partido => $cantidad) {
    if (in_array($partido,$partidosSeleccionados,true)) {
        $sumarEscanos+=$cantidad;
    }
}

/* comprobar posibles mayorias  */

$posiblesPactos = [];

$totalEscanos = $escenarios[$escenario]['escanos'];
$mayoria = calcularMayoria($totalEscanos);

foreach ($escenarios[$escenario]['partidos'] as $partido => $cantidad) {

    // Comprobar que el partido NO esté en el pacto actual
    if (!in_array($partido, $partidosSeleccionados, true)) {

        // Calcular los escaños si se uniera
        $nuevosEscanos = $sumarEscanos + $cantidad;

        $posiblesPactos[$partido] = [
            'escanos' => $nuevosEscanos,
            'mayoria' => $nuevosEscanos >= $mayoria
        ];
    }
}

/* buscar el mejor socio adicional */

$mejorSocio = null;
$menorAportacion = PHP_INT_MAX;

if ($sumarEscanos >= $mayoria) {
    $mensaje = "El pacto ya tiene mayoría. No necesita más socios.";
} else {

    foreach ($posiblesPactos as $partido => $datos) {

        if ($datos['mayoria']) {

            // Escaños que aporta este partido
            $aportacion = $datos['escanos'] - $sumarEscanos;

            if ($aportacion < $menorAportacion) {
                $menorAportacion = $aportacion;
                $mejorSocio = $partido;
            }
        }
    }

    if ($mejorSocio === null) {
        $mensaje = "Ningún partido permite alcanzar la mayoría por sí solo.";
    } else {
        $mensaje = "El mejor socio es $mejorSocio, aportando $menorAportacion escaños.";
    }
}







require __DIR__ . '/informe.php';

