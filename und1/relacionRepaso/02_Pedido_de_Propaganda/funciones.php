<?php
// TODO: crea una función euros($numero) para mostrar cantidades con 2 decimales.
// TODO: crea una función escapar($texto) que use htmlspecialchars.

function escapar($texto) {
    echo htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

function formatearImporte(int|float $importe): string {
    return number_format($importe, 2, ',', '.') . ' €';
}