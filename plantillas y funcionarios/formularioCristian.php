<?php
/**
 * Lee y valida un entero de POST.
 * @param string $campo Nombre del input.
 * @param int|null $min Mínimo; null significa sin mínimo.
 * @param int|null $max Máximo; null significa sin máximo.
 * @return int|false Entero válido o false si el dato no sirve.
 */
function validarEntero(string $campo, $min = null, $max = null): int|false
{
    $valor = $_POST[$campo] ?? null;
    return validarValorEntero($valor, $min, $max);
}

/**
 * Valida un entero recibido directamente: sirve para GET y valores de un array.
 * @param mixed $valor Dato que quieres comprobar.
 * @param int|null $min Mínimo opcional.
 * @param int|null $max Máximo opcional.
 * @return int|false Entero válido o false.
 */
function validarValorEntero($valor, $min = null, $max = null): int|false
{
    if (!is_string($valor) && !is_int($valor)) {
        return false;
    }

    $numero = filter_var($valor, FILTER_VALIDATE_INT);
    if ($numero === false) {
        return false;
    }
    if ($min !== null && $numero < $min) {
        return false;
    }
    if ($max !== null && $numero > $max) {
        return false;
    }
    return $numero;
}

/**
 * Lee y valida un decimal de POST. El separador decimal es el punto.
 * @param string $campo Nombre del input.
 * @param float|null $min Mínimo opcional.
 * @param float|null $max Máximo opcional.
 * @return float|false Número válido o false.
 */
function validarDecimal(string $campo, $min = null, $max = null): float|false
{
    $valor = $_POST[$campo] ?? null;
    if (!is_string($valor)) {
        return false;
    }

    $numero = filter_var($valor, FILTER_VALIDATE_FLOAT);
    if ($numero === false) {
        return false;
    }
    if ($min !== null && $numero < $min) {
        return false;
    }
    if ($max !== null && $numero > $max) {
        return false;
    }
    return $numero;
}

/**
 * Lee texto de POST y quita espacios de los extremos.
 * @param string $campo Nombre del input o textarea.
 * @param int|null $min Mínimo de caracteres; null no limita.
 * @param int|null $max Máximo de caracteres; null no limita.
 * @param bool $obligatorio False permite un campo ausente o vacío.
 * @return string|false Texto válido (puede ser '') o false.
 */
function validarTexto(string $campo, $min = null, $max = null, bool $obligatorio = true): string|false
{
    $valor = $_POST[$campo] ?? '';
    if (!is_string($valor)) {
        return false;
    }

    $valor = trim($valor);
    if ($valor === '') {
        if ($obligatorio) {
            return false;
        }
        return '';
    }

    // mb_strlen cuenta caracteres, también cuando hay tildes.
    $longitud = mb_strlen($valor, 'UTF-8');
    if ($min !== null && $longitud < $min) {
        return false;
    }
    if ($max !== null && $longitud > $max) {
        return false;
    }
    return $valor;
}

/**
 * Lee un email obligatorio de POST y comprueba su formato.
 * @param string $campo Nombre del input.
 * @return string|false Email válido o false.
 */
function validarEmail(string $campo): string|false
{
    $valor = $_POST[$campo] ?? null;
    if (!is_string($valor)) {
        return false;
    }
    return filter_var(trim($valor), FILTER_VALIDATE_EMAIL);
}

/**
 * Comprueba una opción de radio o select.
 * @param mixed $valor Dato recibido, por ejemplo $_POST['turno'] ?? null.
 * @param array $opcionesValidas Lista de textos permitidos. Si tienes un catálogo asociativo, pasa array_keys($catalogo).
 * @return bool True si la opción es válida; false si no lo es.
 */
function validarOpcion($valor, array $opcionesValidas): bool
{
    if (!is_string($valor)) {
        return false;
    }
    if (!in_array($valor, $opcionesValidas, true)) {
        return false;
    }
    return true;
}

/**
 * Comprueba un grupo de checkboxes. No modifica sus datos.
 * @param mixed $valores Datos recibidos con $_POST['campo'] ?? [].
 * @param array $opcionesValidas Lista de textos permitidos.
 * @param bool $obligatorio True exige alguna selección; false permite [].
 * @return bool True si todo es válido; false si hay algún dato incorrecto.
 */
function validarCheckboxes($valores, array $opcionesValidas, bool $obligatorio = false): bool
{
    if (!is_array($valores)) {
        return false;
    }
    if ($obligatorio && empty($valores)) {
        return false;
    }
    foreach ($valores as $valor) {
        if (!is_string($valor)) {
            return false;
        }
        if (!in_array($valor, $opcionesValidas, true)) {
            return false;
        }
    }
    return true;
}

/**
 * Escapa texto o números antes de mostrarlos en HTML.
 * @param mixed $texto Valor simple que vas a mostrar; no un array.
 * @return string Texto escapado, o '' si se recibe otro tipo de dato.
 */
function escaparHTML($texto): string
{
    if (!is_string($texto) && !is_int($texto) && !is_float($texto)) {
        return '';
    }
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

/**
 * Presenta un número con coma decimal y punto de miles. No sirve para calcular.
 * @param float $numero Número ya validado o calculado.
 * @param int $decimales Número de decimales que se mostrarán.
 * @return string Número formateado, por ejemplo 1.234,50.
 */
function formato(float $numero, int $decimales = 2): string
{
    return number_format($numero, $decimales, ',', '.');
}

/**
 * Calcula el importe de un porcentaje: 21 % de 100 devuelve 21.
 * @param float $cantidad Cantidad base ya validada.
 * @param float $porcentaje Porcentaje que se aplica.
 * @return float Importe del porcentaje.
 */
function calcularPorcentaje(float $cantidad, float $porcentaje): float
{
    return $cantidad * $porcentaje / 100;
}

/**
 * Extrae la cuota de IVA de un precio que ya lo incluye.
 * @param float $precio Precio con IVA, ya validado.
 * @param float $porcentaje Tipo de IVA no negativo.
 * @return float Cuota de IVA, sin redondear.
 */
function extraerIVAIncluido(float $precio, float $porcentaje = 21): float
{
    if ($porcentaje < 0) {
        exit('El porcentaje de IVA no puede ser negativo');
    }
    return $precio - ($precio / (1 + $porcentaje / 100));
}

/**
 * Genera números aleatorios distintos en un intervalo pequeño, como en clase.
 * @param int $cantidad Cantidad de números que necesitas.
 * @param int $min Menor número posible.
 * @param int $max Mayor número posible.
 * @return array Lista de números. Termina con exit si el rango o la cantidad no sirven.
 */
function generarArraySinRepetidos(int $cantidad, int $min, int $max): array
{
    if ($min > $max || $cantidad < 0 || $cantidad > $max - $min + 1) {
        exit('Cantidad o rango no válido');
    }
    $numeros = range($min, $max);
    shuffle($numeros);
    return array_slice($numeros, 0, $cantidad);
}

/**
 * Escoge elementos al azar conservando sus claves, como tus preguntas de test.
 * @param array $elementos Array de origen.
 * @param int $cantidad Cantidad de elementos que necesitas, como mínimo 1.
 * @return array Elementos seleccionados. Termina con exit si la cantidad no sirve.
 */
function seleccionarAleatorios(array $elementos, int $cantidad): array
{
    if ($cantidad < 1 || $cantidad > count($elementos)) {
        exit('Cantidad no válida');
    }
    // array_rand devuelve una clave si pides 1; con (array) siempre podemos recorrerla.
    $claves = (array) array_rand($elementos, $cantidad);
    $seleccionados = [];
    foreach ($claves as $clave) {
        $seleccionados[$clave] = $elementos[$clave];
    }
    return $seleccionados;
}
