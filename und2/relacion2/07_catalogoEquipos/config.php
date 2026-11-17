<?php

declare(strict_types=1);
function conectar(): PDO
{
    $ruta = 'mysql:host=127.0.0.1;dbname=ud2_catalogo;charset=utf8mb4';
    return new PDO($ruta, 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
}
