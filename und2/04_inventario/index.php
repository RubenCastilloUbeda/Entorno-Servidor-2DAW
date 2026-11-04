<?php
require_once __DIR__ . '/src/dominio/Articulo.php';
require_once __DIR__ . '/src/excepciones/StockInsuficienteException.php';

use App\dominio\Articulo;
use App\excepciones\StockInsuficienteException;

try {
    $articulo = new Articulo('A01', 'Cuaderno', 4);
    $articulo->retirarStock(5);
} catch (\InvalidArgumentException $e) {
    echo $e->getMessage() . "<br>";
} catch (StockInsuficienteException $e) {
    echo $e->mensajePersonalizado();
}
