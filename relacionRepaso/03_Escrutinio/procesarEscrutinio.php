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

// require __DIR__ . '/resultados.php';

