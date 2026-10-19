<?php
require_once __DIR__ . '/datosActos.php';

// TODO 1: comprobar que la petición es GET.
// TODO 2: leer y validar provincia, partido, tipo y limite (1..10).
//          Permitir "Todas" / "Todos" para no filtrar ese campo.
// TODO 3: recorrer $actos y guardar todos los que cumplen LOS TRES filtros.
// TODO 4: calcular cantidad de coincidencias y aforo total coincidente.
// TODO 5: mostrar solo los primeros $limite actos usando una vista externa.


function mostrar($dato) {
    echo htmlspecialchars((string) $dato, ENT_QUOTES, 'UTF-8');
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'GET') {
    http_response_code(405);
    exit('Envía el formulario mediante GET.');
}

$provincia=$_GET["provincia"] ?? null;
    if (!is_string($provincia) || !in_array($provincia, $provincias, true) && $provincia!=="Todas") {
        exit('Selecciona una provincia válida.');
    }
$partido=$_GET["partido"] ?? null;
    if (!is_string($partido) || !in_array($partido, $partidos,true) && $partido!=="Todos") {
        exit('Selecciona un partido válido.');
    }
$tipo=$_GET["tipo"] ?? null;
    if (!is_string($tipo) || !in_array($tipo, $tipos,true) && $tipo!=="Todos") {
        exit('Selecciona un tipo válido.');
    }

$cantidadActos = filter_var($_GET["limite"] ?? null,
    FILTER_VALIDATE_INT,['options' => ['min_range' => 1, 'max_range' => 10]]);

$actosEncontrados = [];

foreach ($actos as $acto) {
    if (
        ($provincia === 'Todas' || $acto['provincia'] === $provincia) &&
        ($partido === 'Todos' || $acto['partido'] === $partido) &&
        ($tipo === 'Todos' || $acto['tipo'] === $tipo)){
            $actosEncontrados[] = $acto;
        }
    }

$aforoTotal=0;

foreach ($actosEncontrados as $acto) {
    $aforoTotal+= (int)$acto["aforo"];
}

require __DIR__ . '/agendaResultado.php';

