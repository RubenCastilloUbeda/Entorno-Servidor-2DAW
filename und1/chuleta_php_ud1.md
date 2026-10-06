# PHP — Chuleta rápida UD1

## 1. Estructura básica

### Bloque PHP

```php
<?php

// Código PHP

?>
```

### `echo` — mostrar contenido

```php
echo "Hola";
echo $nombre;
echo "<h1>" . $nombre . "</h1>";
```

Concatenar cadenas → `.`

```php
echo "Hola " . $nombre;
```

# 2. Variables y tipos

## Declarar una variable

```php
$nombre = "Juan";
$edad = 25;
$altura = 1.75;
$activo = true;
```

- Las variables empiezan por `$`.
- PHP determina el tipo automáticamente.
- PHP distingue mayúsculas/minúsculas: `$nombre` ≠ `$Nombre`.

### Tipos básicos

```php
$string = "Hola";
$int = 25;
$float = 1.75;
$bool = true;
$null = null;
```

### Conversión de tipos

```php
(int) $valor;
(float) $valor;
(string) $valor;
(bool) $valor;
(array) $valor;
```

Ejemplo:

```php
$numero = "25";
$numeroEntero = (int) $numero;
```

---

# 3. Operadores

## Aritméticos

| Operador | Uso |
|---|---|
| `+` | Suma |
| `-` | Resta |
| `*` | Multiplicación |
| `/` | División |
| `%` | Resto |

```php
$resultado = 10 + 3;
$resultado = 10 - 3;
$resultado = 10 * 3;
$resultado = 10 / 3;
$resultado = 10 % 3;
```

## Asignación

```php
$a = 5;

$a += 3;   // $a = $a + 3
$a -= 3;   // $a = $a - 3
$a *= 3;   // $a = $a * 3
$a /= 3;   // $a = $a / 3
$a %= 3;   // $a = $a % 3
```

## Comparación

```php
$a == $b    // Igual valor
$a === $b   // Igual valor y mismo tipo
$a != $b    // Diferente
$a !== $b   // Diferente valor o tipo
$a > $b
$a < $b
$a >= $b
$a <= $b
```

**Preferible en comprobaciones:** `===` y `!==`.

## Lógicos

```php
$a && $b    // AND: ambas verdaderas
$a || $b    // OR: al menos una verdadera
!$a         // NOT: invierte
```

## Incremento / decremento

```php
$i++;
$i--;

++$i;
--$i;
```

---

# 4. Arrays

## Array indexado

```php
$frutas = ["manzana", "naranja", "pera"];

echo $frutas[0]; // manzana
```

También:

```php
$frutas = array("manzana", "naranja", "pera");
```

## Array asociativo

```php
$persona = [
    "nombre" => "Juan",
    "edad" => 25
];

echo $persona["nombre"];
```

## Array multidimensional

```php
$personas = [
    ["nombre" => "Juan", "edad" => 25],
    ["nombre" => "Ana", "edad" => 30]
];

echo $personas[1]["nombre"];
```

---

# 5. Funciones de arrays

| Función | Para qué sirve |
|---|---|
| `count($array)` | Número de elementos |
| `array_push($array, $valor)` | Añadir al final |
| `array_pop($array)` | Eliminar/devolver último |
| `sort($array)` | Ordenar ascendentemente |
| `array_merge($a, $b)` | Unir arrays |
| `array_keys($array)` | Obtener claves |
| `array_values($array)` | Obtener valores |
| `isset($array["clave"])` | Comprueba si existe y no es `null` |
| `array_key_exists("clave", $array)` | Comprueba si existe la clave |
| `unset($array["clave"])` | Elimina un elemento |
| `array_combine($claves, $valores)` | Crear array asociativo |
| `in_array($valor, $array, true)` | Comprueba si existe un valor |
| `array_rand($array, $n)` | Elegir claves aleatorias |
| `array_unique($array)` | Eliminar repetidos |
| `array_map(...)` | Aplicar una función a cada elemento |
| `array_walk_recursive(...)` | Recorrer recursivamente |

Ejemplos:

```php
count($frutas);

array_push($frutas, "uva");

$ultima = array_pop($frutas);

sort($frutas);

$nuevo = array_merge($a, $b);

$claves = array_keys($persona);

$valores = array_values($persona);

unset($persona["edad"]);

if (in_array("Juan", $nombres, true)) {
    // existe
}
```

---

# 6. Recorrer arrays

## `foreach` — valor

```php
foreach ($frutas as $fruta) {
    echo $fruta;
}
```

## `foreach` — clave y valor

```php
foreach ($persona as $clave => $valor) {
    echo "$clave: $valor";
}
```

**Para recordar:**

```text
array as valor
array as clave => valor
```

---

# 7. Condicionales

## `if / elseif / else`

```php
if ($edad >= 18) {
    echo "Mayor";
} elseif ($edad >= 16) {
    echo "Casi";
} else {
    echo "Menor";
}
```

## `switch`

```php
switch ($opcion) {
    case 1:
        echo "Opción 1";
        break;

    case 2:
        echo "Opción 2";
        break;

    default:
        echo "Otra opción";
}
```

---

# 8. Bucles

## `for`

Cuando sabes aproximadamente cuántas veces repetir.

```php
for ($i = 0; $i < 5; $i++) {
    echo $i;
}
```

Estructura:

```php
for (inicio; condición; actualización) {
    // código
}
```

## `while`

Mientras se cumpla una condición.

```php
$i = 0;

while ($i < 5) {
    echo $i;
    $i++;
}
```

## `do...while`

Se ejecuta **al menos una vez**.

```php
$i = 0;

do {
    echo $i;
    $i++;
} while ($i < 5);
```

## `foreach`

Para recorrer arrays.

```php
foreach ($array as $elemento) {
    // código
}
```

---

# 9. Funciones propias

## Crear una función

```php
function calcularSubtotal($precio, $cantidad) {
    return $precio * $cantidad;
}
```

## Llamarla

```php
$total = calcularSubtotal(12.5, 3);

echo $total;
```

Estructura:

```php
function nombreFuncion($parametro1, $parametro2) {
    // código
    return $resultado;
}
```

### `return`

Devuelve un resultado y termina la función.

```php
function sumar($a, $b) {
    return $a + $b;
}
```

---

# 10. Funciones de texto

| Función | Uso |
|---|---|
| `trim($texto)` | Quitar espacios al principio/final |
| `strtoupper($texto)` | Convertir a mayúsculas |
| `ucfirst($texto)` | Primera letra en mayúscula |
| `str_replace($buscar, $nuevo, $texto)` | Reemplazar texto |
| `htmlspecialchars($texto, ENT_QUOTES, 'UTF-8')` | Escapar texto para HTML |

Ejemplos:

```php
$nombre = trim($nombre);

$codigo = strtoupper($codigo);

$asignatura = ucfirst($asignatura);

$codigo = str_replace("-", "", "12-34");
// 1234
```

### Mostrar datos externos en HTML

```php
echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
```

---

# 11. Funciones de números

```php
round(12.345, 2);
// 12.35
```

```php
number_format($precio, 2, ',', '.');
// 12,35
```

---

# 12. Fechas y horas

## `date()`

```php
echo date("Y/m/d");
echo date("h:i:sa");
```

## `strtotime()`

Convierte una fecha/hora textual a una marca de tiempo.

```php
$inicio = strtotime("08:30");
$fin = strtotime("10:00");

$horas = ($fin - $inicio) / 3600;
```

---

# 13. Valores que pueden no existir

## Operador `??`

Usa un valor alternativo si la variable/clave no existe o es `null`.

```php
$nombre = $_POST["nombre"] ?? "";
```

Muy habitual con formularios:

```php
$asignaturas = $_POST["asignaturas"] ?? [];
```

---

# 14. Comprobar valores

## `isset()`

Comprueba que existe y no es `null`.

```php
if (isset($nombre)) {
    echo $nombre;
}
```

Con arrays:

```php
if (isset($persona["nombre"])) {
    echo $persona["nombre"];
}
```

## `array_key_exists()`

Comprueba que la **clave existe**, incluso si su valor es `null`.

```php
if (array_key_exists("nombre", $persona)) {
    // existe la clave
}
```

## `is_array()` / `is_string()`

```php
is_array($dato);

is_string($dato);
```

---

# 15. Formularios

## HTML básico

```html
<form action="procesar.php" method="POST">
    <input type="text" name="nombre">
    <button type="submit">Enviar</button>
</form>
```

El atributo `name` determina la clave que recibirá PHP.

```html
<input name="nombre">
```

↓

```php
$_POST["nombre"]
```

---

## `GET`

Los datos llegan en la URL.

```php
$nombre = $_GET["nombre"] ?? "";
```

## `POST`

Los datos llegan mediante el cuerpo de la petición.

```php
$nombre = $_POST["nombre"] ?? "";
```

---

# 16. Comprobar que se ha enviado por POST

```php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // procesar formulario
}
```

También se puede detener si no es POST:

```php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Este archivo requiere POST.");
}
```

---

# 17. Formularios con arrays

## Checkbox múltiple

HTML:

```html
<input type="checkbox" name="aficiones[]" value="cine">
<input type="checkbox" name="aficiones[]" value="musica">
```

PHP:

```php
$aficiones = $_POST["aficiones"] ?? [];
```

Recorrer:

```php
foreach ($aficiones as $aficion) {
    echo $aficion;
}
```

**Importante:**

```text
HTML → name="aficiones[]"

PHP → $_POST["aficiones"]
```

Los `[]` hacen que PHP reciba varios valores como array.

---

# 18. Validación de formularios

## Campo obligatorio

```php
if (trim($_POST["nombre"] ?? "") === "") {
    echo "El nombre es obligatorio.";
}
```

## Validar tipo de array

```php
$aficiones = $_POST["aficiones"] ?? [];

if (!is_array($aficiones)) {
    exit("Selección no válida.");
}
```

## Expresiones regulares — `preg_match()`

```php
if (!preg_match("/^[0-9]{5}$/", $codigoPostal)) {
    echo "Código postal no válido.";
}
```

Ejemplo: exactamente 5 dígitos.

```php
/^[0-9]{5}$/
```

### `checkdate()`

Comprobar una fecha:

```php
if (!checkdate($mes, $dia, $anio)) {
    echo "Fecha no válida.";
}
```

---

# 19. Subida de archivos

HTML:

```html
<form method="POST"
      enctype="multipart/form-data">

    <input type="file" name="archivo">

    <button type="submit">Subir</button>
</form>
```

PHP:

```php
$archivo = $_FILES["archivo"] ?? null;
```

Comprobar subida:

```php
if ($archivo === null || $archivo["error"] !== UPLOAD_ERR_OK) {
    exit("No se ha recibido un archivo válido.");
}
```

Mover archivo:

```php
move_uploaded_file(
    $archivo["tmp_name"],
    $destino
);
```

---

# 20. Archivos PHP

## `require_once`

Incluir otro archivo PHP una sola vez:

```php
require_once __DIR__ . "/componentes.php";
```

`__DIR__` → directorio del archivo PHP actual.

---

# 21. Control de ejecución

## `exit()`

Detiene el script.

```php
exit("Ha ocurrido un error.");
```

## Código HTTP

```php
http_response_code(405);
```

---

# 22. Chuleta de superglobales

| Superglobal | Contiene |
|---|---|
| `$_GET` | Datos enviados mediante GET |
| `$_POST` | Datos enviados mediante POST |
| `$_FILES` | Archivos enviados |
| `$_SESSION` | Datos de sesión |
| `$_COOKIE` | Cookies |
| `$_SERVER` | Información de la petición/servidor |

---

# 23. Patrón típico de ejercicio con formulario

```php
<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Formulario no enviado.");
}

$nombre = trim($_POST["nombre"] ?? "");
$edad = $_POST["edad"] ?? "";
$asignaturas = $_POST["asignaturas"] ?? [];

if ($nombre === "") {
    exit("El nombre es obligatorio.");
}

if (!is_array($asignaturas)) {
    exit("Asignaturas no válidas.");
}

foreach ($asignaturas as $asignatura) {
    echo htmlspecialchars($asignatura, ENT_QUOTES, "UTF-8");
}
```

---

## 📌 Regla mental para formularios

```text
HTML name
   ↓
$_POST["name"]
   ↓
validar
   ↓
procesar
   ↓
mostrar
```

Y si es múltiple:

```text
name="asignaturas[]"
          ↓
$_POST["asignaturas"]
          ↓
array
          ↓
foreach
```
