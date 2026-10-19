# Tu kit sencillo de DWES

## Índice

- [Tu kit sencillo de DWES](#tu-kit-sencillo-de-dwes)
  - [Índice](#índice)
  - [Qué devuelve cada función](#qué-devuelve-cada-función)
  - [1. Texto y límites](#1-texto-y-límites)
  - [2. Enteros y decimales](#2-enteros-y-decimales)
  - [3. Radio y select: la misma validación](#3-radio-y-select-la-misma-validación)
  - [4. Checkboxes opcionales u obligatorios](#4-checkboxes-opcionales-u-obligatorios)
  - [5. Checkbox individual obligatorio](#5-checkbox-individual-obligatorio)
  - [6. Select múltiple](#6-select-múltiple)
  - [7. GET, como en tu agenda](#7-get-como-en-tu-agenda)
  - [8. Un array de cantidades con claves exactas](#8-un-array-de-cantidades-con-claves-exactas)
  - [9. Plantillas HTML para resultados](#9-plantillas-html-para-resultados)
    - [Tabla de clave y valor](#tabla-de-clave-y-valor)
    - [Tabla de filas asociativas](#tabla-de-filas-asociativas)
    - [Lista](#lista)
    - [for y endfor](#for-y-endfor)
    - [if, elseif y else](#if-elseif-y-else)
    - [Vista en otro archivo](#vista-en-otro-archivo)
  - [10. Explicaciones cortas para defenderlo](#10-explicaciones-cortas-para-defenderlo)

## Qué devuelve cada función

| Función            | Qué le pasas                                         | Qué devuelve    |
| ------------------ | ---------------------------------------------------- | --------------- |
| validarEntero      | Nombre del campo POST, mínimo y máximo opcionales    | Entero o false  |
| validarDecimal     | Nombre del campo POST, mínimo y máximo opcionales    | Decimal o false |
| validarTexto       | Nombre, límites opcionales y si es obligatorio       | Texto o false   |
| validarEmail       | Nombre del campo POST                                | Email o false   |
| validarValorEntero | Un valor, no el nombre de un campo                   | Entero o false  |
| validarOpcion      | Valor recibido y opciones válidas                    | true o false    |
| validarCheckboxes  | Array recibido, opciones válidas y si es obligatorio | true o false    |

Con las cuatro primeras, escribe siempre `if ($variable === false) { exit(...); }`. Llamar a la función no termina el programa si el dato es incorrecto.

## 1. Texto y límites

```php
$nombre = validarTexto('nombre');                  // Obligatorio, sin límites.
$nombre = validarTexto('nombre', 2, 30);           // De 2 a 30 caracteres.
$nombre = validarTexto('nombre', null, 30);        // Obligatorio, máximo 30.
$comentario = validarTexto('comentario', null, null, false); // Opcional.
```

Copia solo la variante necesaria. Después comprueba el resultado:

```php
if ($nombre === false) {
    exit('Nombre no válido');
}
```

La función primero comprueba `is_string`, después hace `trim`. Si el campo es opcional y está vacío, devuelve ''. El mínimo y máximo se aplican cuando contiene texto. `mb_strlen` ya aparece en tus ejercicios y cuenta caracteres con tildes.

## 2. Enteros y decimales

```php
$cantidad = validarEntero('cantidad', 1, 5);
if ($cantidad === false) {
    exit('La cantidad debe ser un entero entre 1 y 5');
}

$precio = validarDecimal('precio', 0, 1000);
if ($precio === false) {
    exit('Precio no válido');
}
```

Puedes omitir ambos límites o pasar solo el mínimo. Para imponer únicamente el máximo: `validarEntero('cantidad', null, 100)`.

`=== false` distingue un error del número 0. No uses `empty` para decidir si un número es válido. El decimal admite punto; no convierte una coma a punto. El formato de dos decimales al mostrarlo no es una validación de cuántos decimales se enviaron.

## 3. Radio y select: la misma validación

Radio:

```html
<fieldset>
    <legend>Turno</legend>
    <label><input type="radio" name="turno" value="manana" required> Mañana</label>
    <label><input type="radio" name="turno" value="tarde" required> Tarde</label>
</fieldset>
```

Select:

```html
<label for="turno">Turno</label>
<select name="turno" id="turno" required>
    <option value="">Selecciona...</option>
    <option value="manana">Mañana</option>
    <option value="tarde">Tarde</option>
</select>
```

Elige uno de los dos HTML. Ambos se validan así:

```php
$turno = $_POST['turno'] ?? null;
if (!validarOpcion($turno, ['manana', 'tarde'])) {
    exit('Turno no válido');
}
```

La función comprueba que llega texto y que pertenece a las opciones permitidas. Si el catálogo es asociativo, pasa sus claves:

```php
$packs = ['basico' => 20, 'completo' => 40];
$pack = $_POST['pack'] ?? null;
if (!validarOpcion($pack, array_keys($packs))) {
    exit('Pack no válido');
}
$precio = $packs[$pack];
```

Usa valores de texto en la lista, también si son números: ['1', '2']. Para un catálogo con claves numéricas, comprueba `is_string($valor)` y `array_key_exists($valor, $catalogo)`, como haces en el concesionario: las claves numéricas de PHP pueden ser enteros y no coincidir estrictamente con los strings de POST.

## 4. Checkboxes opcionales u obligatorios

```html
<fieldset>
    <legend>Aficiones</legend>
    <label><input type="checkbox" name="aficiones[]" value="cine"> Cine</label>
    <label><input type="checkbox" name="aficiones[]" value="musica"> Música</label>
</fieldset>
```

```php
$aficiones = $_POST['aficiones'] ?? [];
$aficionesValidas = ['cine', 'musica'];

if (!validarCheckboxes($aficiones, $aficionesValidas)) {
    exit('Aficiones no válidas');
}
$aficiones = array_unique($aficiones);
```

Si es obligatorio marcar alguna, añade true:

```php
if (!validarCheckboxes($aficiones, $aficionesValidas, true)) {
    exit('Selecciona al menos una afición válida');
}
```

La función ya comprueba que sea un array, que no esté vacío si es obligatorio, que cada elemento sea texto y que sea una opción permitida. No tienes que repetir esos if antes de llamarla. `array_unique` queda fuera, después de validar.

Si prefieres mensajes diferentes para cada fallo, utiliza este bloque EN LUGAR de la llamada:

```php
$aficiones = $_POST['aficiones'] ?? [];
$aficionesValidas = ['cine', 'musica'];

if (!is_array($aficiones)) {
    exit('Las aficiones deben enviarse como una lista');
}
// Quita este if si las casillas son opcionales.
if (empty($aficiones)) {
    exit('Selecciona al menos una afición');
}
foreach ($aficiones as $aficion) {
    if (!is_string($aficion) || !in_array($aficion, $aficionesValidas, true)) {
        exit('Afición no válida');
    }
}
$aficiones = array_unique($aficiones);
```

Para un límite de selecciones, después de validar y quitar duplicados:

```php
if (count($aficiones) > 2) {
    exit('Puedes seleccionar como máximo dos aficiones');
}
```

No pongas required en todas las casillas para exigir «al menos una»: obligaría a marcar cada casilla con required. El grupo se comprueba en PHP.

## 5. Checkbox individual obligatorio

```html
<label><input type="checkbox" name="acepto" value="si" required> Acepto</label>
```

```php
$acepto = $_POST['acepto'] ?? null;
if (!validarOpcion($acepto, ['si'])) {
    exit('Debes marcar la casilla');
}
```

No lleva [] porque es una única casilla. Si es opcional:

```php
$acepto = $_POST['acepto'] ?? null;
if ($acepto !== null && !validarOpcion($acepto, ['si'])) {
    exit('Valor de casilla no válido');
}
$marcado = $acepto === 'si';
```

## 6. Select múltiple

```html
<select name="asignaturas[]" multiple>
    <option value="DWES">DWES</option>
    <option value="DWEC">DWEC</option>
</select>
```

```php
$asignaturas = $_POST['asignaturas'] ?? [];
if (!validarCheckboxes($asignaturas, ['DWES', 'DWEC'], true)) {
    exit('Selecciona alguna asignatura válida');
}
$asignaturas = array_unique($asignaturas);
```

## 7. GET, como en tu agenda

```php
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    exit('Acceso no permitido');
}

$limite = validarValorEntero($_GET['limite'] ?? null, 1, 10);
if ($limite === false) {
    exit('Límite no válido');
}

$provincia = $_GET['provincia'] ?? null;
if (!validarOpcion($provincia, ['Todas', 'Granada', 'Sevilla', 'Málaga'])) {
    exit('Provincia no válida');
}
```

No hace falta otra función para radio o select de GET: validarOpcion recibe el valor directamente.

## 8. Un array de cantidades con claves exactas

No uses validarCheckboxes para cantidades: cada valor debe ser un entero, no una opción del catálogo.

```html
<label>Cantidad A <input type="number" name="cantidades[a]" min="0" required></label>
<label>Cantidad B <input type="number" name="cantidades[b]" min="0" required></label>
```

```php
$clavesValidas = ['a', 'b']; // Catálogo del programa, sin claves repetidas.
$cantidades = $_POST['cantidades'] ?? [];

if (!is_array($cantidades)) {
    exit('Las cantidades deben enviarse como una lista');
}
if (count($cantidades) !== count($clavesValidas)) {
    exit('Número de elementos incorrecto');
}
foreach ($clavesValidas as $clave) {
    if (!array_key_exists($clave, $cantidades)) {
        exit('Falta un elemento del catálogo');
    }
}
foreach ($cantidades as $clave => $valor) {
    $numero = validarValorEntero($valor, 0);
    if ($numero === false) {
        exit('Todas las cantidades deben ser enteros no negativos');
    }
    $cantidades[$clave] = $numero;
}
$total = array_sum($cantidades);
```

Es la misma estructura de tu escrutinio, pero genérica. Al tener igual cantidad de claves y estar todas las esperadas, no puede haber claves extra. Los valores quedan convertidos a enteros.

## 9. Plantillas HTML para resultados

Estos bloques van en un archivo .php. Cambia los nombres de las variables según tu ejercicio. No se ejecutan todos juntos: son alternativas para copiar.

### Tabla de clave y valor

```php
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datos as $nombre => $cantidad): ?>
            <tr>
                <td><?= escaparHTML($nombre) ?></td>
                <td><?= escaparHTML($cantidad) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
```

### Tabla de filas asociativas

Para datos como `[['nombre' => 'A', 'precio' => 20], ...]`:

```php
<table>
    <thead>
        <tr><th>Nombre</th><th>Precio</th></tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?= escaparHTML($producto['nombre']) ?></td>
                <td><?= formato($producto['precio']) ?> €</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
```

### Lista

```php
<ul>
    <?php foreach ($aficiones as $aficion): ?>
        <li><?= escaparHTML($aficion) ?></li>
    <?php endforeach; ?>
</ul>
```

### for y endfor

```php
<?php for ($i = 0; $i < $cantidad; $i++): ?>
    <div><p><?= $i ?></p></div>
<?php endfor; ?>
```

### if, elseif y else

```php
<?php if ($total > 100): ?>
    <p>Mayor que 100.</p>
<?php elseif ($total == 100): ?>
    <p>Igual a 100.</p>
<?php else: ?>
    <p>Menor que 100.</p>
<?php endif; ?>
```

### Vista en otro archivo

Al final del PHP de procesamiento:

```php
require __DIR__ . '/vistas/resultado.php';
```

Dentro de resultado.php pegas el HTML y utilizas las variables calculadas, como ya haces en la agenda y el pedido. No incluyas también el mismo HTML en el procesador.

## 10. Explicaciones cortas para defenderlo

- `null`: «No se ha indicado ese límite».
- `= null`: «Si no paso ese argumento, toma null por defecto».
- `?? []`: «Si no llega el grupo de casillas, uso un array vacío».
- `is_string`: «Compruebo que llega texto antes de tratarlo como texto».
- `=== false`: «Compruebo si falló la validación, sin confundirlo con cero».
- `in_array(..., true)`: «Compruebo que el valor esté permitido y coincida también el tipo».
- `array_keys`: «Obtengo las claves del catálogo para validar las opciones».
- `array_unique`: «Quito los valores repetidos».
- `validarEntero` llama a `validarValorEntero`: «La primera recoge el campo POST; la segunda comprueba el número, y también me sirve para GET o para un array».

PHPDoc son comentarios: ayudan al autocompletado y no ejecutan código. `@param mixed` significa que el dato recibido puede ser de cualquier tipo y que la función lo comprueba por dentro.

Los límites, catálogos y parámetros de configuración los escribes tú; no se toman del POST. Los cálculos y el formato se usan después de validar. Las reglas propias del enunciado (cantidades compatibles, sumas que no superen un límite, etc.) se añaden en el ejercicio, antes de calcular el resultado.
