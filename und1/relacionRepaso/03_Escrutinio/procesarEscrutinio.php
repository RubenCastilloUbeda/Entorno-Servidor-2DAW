<?php
require_once __DIR__ . '/datosPartidos.php';

// TODO 1: aceptar POST y validar censo entero entre 1 y 100000.
// TODO 2: validar que votos[] contiene exactamente las claves de $partidos,
//          y que todos los votos, blancos y nulos son enteros >= 0.
// TODO 3: votos a candidaturas, votos válidos (candidaturas + blancos),
//          emitidos (válidos + nulos), abstención y participación.
// TODO 4: rechazar votos emitidos > censo y recuentos de 0 emitidos.
// TODO 5: calcular porcentajes de cada partido sobre VOTOS VÁLIDOS,
//          ordenar de más a menos votos e identificar empate en el primer puesto.
// TODO 6: contar cuántos partidos alcanzan el umbral didáctico del 5 %.
// TODO 7: mostrar tabla HTML mediante vistas/resultados.php.


function mostrar($dato) {
    echo htmlspecialchars((string) $dato, ENT_QUOTES, 'UTF-8');
}

/* Validacion de datos*/
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    exit('Envía el formulario mediante POST.');
}

$censo = filter_var($_POST['censo'] ?? null,
    FILTER_VALIDATE_INT,
    ['options' => ['min_range' => 1, 'max_range' => 100]]
);

$votos= $_POST['votos'] ?? [];
if (!is_array($votos) || empty($votos)) {
    exit('Votos no validos.');
}

foreach ($votos as $partido => $voto) {
    if (!in_array($partido, $partidos, true)) {
        exit('Partido no válido.');
    }

    if (filter_var($voto, FILTER_VALIDATE_INT) === false || (int)$voto < 0) {
        exit('Hay un voto no válido.');
    }
}

$votosBlanco = $_POST['blancos'] ?? null;
if (filter_var($votosBlanco, FILTER_VALIDATE_INT) === false || (int)$votosBlanco < 0) {
        exit('Votos en blanco no validos.');
    }

$votosNulos = $_POST['nulos'] ?? null;
if (filter_var($votosNulos, FILTER_VALIDATE_INT) === false || (int)$votosNulos < 0) {
        exit('Votos nulos no validos.');
    }

/* calcular datos de partidos y votos */
/* foreach ($votos as $partido => $cantidadVotos) {
        $votosTodosLosPartidos+=$cantidadVotos;
    }
    $votosValidos=$votosTodosLosPartidos+$votosBlanco;*/

$votosTodosLosPartidos=array_sum($votos);
$votosValidos=$votosTodosLosPartidos+$votosBlanco;
$votosEmitidos=$votosValidos+$votosNulos;

arsort($votos);

if ($votosEmitidos>$censo) {
    exit ("Votos emitidos mayores que censo total");
}

$abstencion=$censo-$votosEmitidos;
$participacion=($votosEmitidos*100)/$censo;

// Calcular porcentaje de cada partido
$porcentajes = [];

foreach ($votos as $partido => $cantidad) {
    $porcentajes[$partido] = ($cantidad / $votosValidos) * 100;
}



require __DIR__ . '/resultados.php';