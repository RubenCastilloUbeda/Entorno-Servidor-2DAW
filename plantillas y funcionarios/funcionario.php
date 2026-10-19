<?php

// 1. Mostrar una variable escapando su contenido
function mostrar($dato) {
    echo htmlspecialchars((string) $dato, ENT_QUOTES, 'UTF-8');
}

// 2. Obtener un dato de POST con un valor por defecto
function post(string $campo, mixed $defecto = ''): mixed {
    return $_POST[$campo] ?? $defecto;
}

// 3. Comprobar si la petición es POST
function esPost(): bool {
    return ($_SERVER['REQUEST_METHOD'] ?? '') === 'POST';
}

// 4. Comprobar si un campo existe y no está vacío
function campoRellenado(mixed $valor): bool {
    return isset($valor) && !is_array($valor) && trim((string) $valor) !== '';
}

// 5. Comprobar si un valor es numérico
function esNumerico(mixed $valor): bool {
    return is_numeric($valor);
}

// 6. Comprobar si un número está dentro de un rango
function estaEnRango(mixed $valor, float $min, float $max): bool {
    return is_numeric($valor)
        && $valor >= $min
        && $valor <= $max;
}

// 7. Comprobar si un valor pertenece a un array
function esOpcionValida(mixed $valor, array $opciones): bool {
    return in_array($valor, $opciones, true);
}

// 8. Obtener un array de POST de forma segura
function postArray(string $campo): array {
    $valor = $_POST[$campo] ?? [];
    return is_array($valor) ? $valor : [];
}

// 9. Comprobar si una cadena tiene una longitud mínima
function longitudMinima(string $texto, int $min): bool {
    return mb_strlen(trim($texto), 'UTF-8') >= $min;
}

// 10. Comprobar si una cadena tiene una longitud máxima
function longitudMaxima(string $texto, int $max): bool {
    return mb_strlen(trim($texto), 'UTF-8') <= $max;
}

// 11. Comprobar si un email tiene un formato válido
function emailValido(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// 12. Redirigir a otra página y detener la ejecución
function redirigir(string $url): never {
    header('Location: ' . $url);
    exit;
}

// 13. Mostrar un mensaje y detener la ejecución
function errorYSalir(string $mensaje, int $codigo = 400): never {
    http_response_code($codigo);
    exit(htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'));
}

// 14. Obtener un valor de un array asociativo con valor por defecto
function obtener(array $datos, string|int $clave, mixed $defecto = null): mixed {
    return $datos[$clave] ?? $defecto;
}

// 15. Formatear un número como importe con dos decimales
function formatearImporte(int|float $importe): string {
    return number_format($importe, 2, ',', '.') . ' €';
}

// 16. Validar que un valor sea un entero dentro de un rango
function enteroEnRango(mixed $valor, int $min, int $max): bool {
    $entero = filter_var($valor, FILTER_VALIDATE_INT);

    return $entero !== false
        && $entero >= $min
        && $entero <= $max;
}