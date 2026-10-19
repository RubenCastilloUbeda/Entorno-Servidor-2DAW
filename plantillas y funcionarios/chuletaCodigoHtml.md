# CHULETA PHP + HTML PARA EXÁMENES
## 1. Las dos formas de construir HTML con PHP

Existen dos formas habituales de generar HTML desde PHP.

Forma A: cerrar PHP y escribir HTML directamente
Es la más cómoda cuando hay mucho HTML y poco PHP. 

```php
<?php
$nombre = "Carlos";
$precio = 25.50;
?>
```

```php
<h1>Resumen del pedido</h1>

<p>Nombre: <?= htmlspecialchars($nombre) ?></p>
<p>Precio: <?= number_format($precio, 2, ',', '.') ?> €</p>
```

Cómo funciona:

<?php inicia el código PHP.
?> cierra PHP y permite escribir HTML normal.
<?= $variable ?> muestra el valor de una variable.
htmlspecialchars() protege el HTML al mostrar texto.
number_format() permite formatear números.

Forma B: construir todo con echo
Es útil cuando el ejercicio pide generar todo el HTML desde PHP.

```php
$nombre = "Carlos";
$precio = 25.50;
```

```php

echo '<h1>Resumen del pedido</h1>';

echo '<p>Nombre: ' . htmlspecialchars($nombre) . '</p>';

echo '<p>Precio: '
    . number_format($precio, 2, ',', '.') . ' €</p>';
?>
```


Regla importante: dentro de una cadena con comillas simples, las variables no se sustituyen automáticamente. Para concatenar se utiliza el punto ..

```php
echo '<p>Hola ' . $nombre . '</p>';
```


En cambio, con comillas dobles sí se pueden interpolar variables:

```php
echo "<p>Hola $nombre </p>";
```

## 1. Mostrar una variable
Con HTML y PHP mezclados

```php
<p>Nombre: <?= htmlspecialchars($nombre) ?></p>
<p>Edad: <?= (int)$edad ?> años</p>
<p>Precio: <?= number_format($precio, 2, ',', '.') ?> €</p>
```


Con echo
```php
echo '<p>Nombre: ' . htmlspecialchars($nombre) . '</p>';
echo '<p>Edad: ' . (int)$edad . ' años</p>';
echo '<p>Precio: ' . number_format($precio, 2, ',', '.') . ' €</p>';
```

Mostrar un resultado solo si se cumple una condición
```php
<?php if ($total > 100): ?>
    <p>El pedido supera los 100 €.</p>
<?php else: ?>
    <p>El pedido no supera los 100 €.</p>
<?php endif; ?>
```

Con echo:

```php
if ($total > 100) {
    echo '<p>El pedido supera los 100 €.</p>';
} else {
    echo '<p>El pedido no supera los 100 €.</p>';
}
```

## 3. Mostrar una tabla con variables individuales

Se utiliza cuando hay pocos datos concretos, como un ticket, un presupuesto o un resumen.

```html
<table border="1">
    <tr>
        <th>Concepto</th>
        <th>Detalle</th>
    </tr>
    <tr>
        <td>Nombre</td>
        <td><?= htmlspecialchars($nombre) ?></td>
    </tr>
    <tr>
        <td>Cantidad</td>
        <td><?= (int)$cantidad ?></td>
    </tr>
    <tr>
        <td>Precio</td>
        <td><?= number_format($precio, 2, ',', '.') ?> €</td>
    </tr>
    <tr>
        <th>Total</th>
        <th><?= number_format($total, 2, ',', '.') ?> €</th>
    </tr>
</table>
```

La misma tabla con echo

```html
echo '<table border="1">';

echo '<tr><th>Concepto</th><th>Detalle</th></tr>';

echo '<tr>';
echo '<td>Nombre</td>';
echo '<td>' . htmlspecialchars($nombre) . '</td>';
echo '</tr>';

echo '<tr>';
echo '<td>Cantidad</td>';
echo '<td>' . (int)$cantidad . '</td>';
echo '</tr>';

echo '<tr>';
echo '<td>Precio</td>';
echo '<td>' . number_format($precio, 2, ',', '.') . ' €</td>';
echo '</tr>';

echo '<tr>';
echo '<th>Total</th>';
echo '<th>' . number_format($total, 2, ',', '.') . ' €</th>';
echo '</tr>';

echo '</table>';
```

## 1. Tabla con foreach: el patrón más importante

Se utiliza cuando tenemos un array y queremos mostrar todos sus elementos.

Ejemplo 1: array simple

PHP:
```php
$frutas = ["Manzana", "Pera", "Naranja"];
```


HTML + PHP:

```html
<table border="1">
    <tr>
        <th>Fruta</th>
    </tr>

    <?php foreach ($frutas as $fruta): ?>
        <tr>
            <td><?= htmlspecialchars($fruta) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
```


Con echo:

```php
echo '<table border="1">';
echo '<tr><th>Fruta</th></tr>';

foreach ($frutas as $fruta) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($fruta) . '</td>';
    echo '</tr>';
}

echo '</table>';
```

Ejemplo 2: array asociativo

PHP:

```php
$precios = [
    "Teclado" => 25,
    "Ratón" => 15,
    "Monitor" => 180
];
```


HTML + PHP:

```html
<table border="1">
    <tr>
        <th>Producto</th>
        <th>Precio</th>
    </tr>

    <?php foreach ($precios as $producto => $precio): ?>
        <tr>
            <td><?= htmlspecialchars($producto) ?></td>
            <td><?= number_format($precio, 2, ',', '.') ?> €</td>
        </tr>
    <?php endforeach; ?>
</table>
```


Importante:

foreach ($array as $valor)


Utiliza cada valor del array.

foreach ($array as $clave => $valor)


Utiliza tanto la clave como el valor.

Ejemplo 3: mostrar un array de arrays

PHP:

```php
$productos = [
    ["nombre" => "Teclado", "precio" => 25, "stock" => 10],
    ["nombre" => "Ratón", "precio" => 15, "stock" => 20],
    ["nombre" => "Monitor", "precio" => 180, "stock" => 5]
];
```


HTML + PHP:

```html
<table border="1">
    <tr>
        <th>Producto</th>
        <th>Precio</th>
        <th>Stock</th>
    </tr>

    <?php foreach ($productos as $producto): ?>
        <tr>
            <td><?= htmlspecialchars($producto['nombre']) ?></td>
            <td><?= number_format($producto['precio'], 2, ',', '.') ?> €</td>
            <td><?= (int)$producto['stock'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
```


La estructura que debes recordar es:

```php
foreach ($productos as $producto) {
    $producto['nombre'];
    $producto['precio'];
    $producto['stock'];
}
```

## 5. Tabla con for y arrays relacionados

Se utiliza cuando los datos están guardados en varios arrays que comparten la misma posición.

PHP:

```php
$nombres = ["Ana", "Luis", "Marta"];
$notas = [8, 6, 9];
```


HTML + PHP:

```html
<table border="1">
    <tr>
        <th>Alumno</th>
        <th>Nota</th>
    </tr>

    <?php for ($i = 0; $i < count($nombres); $i++): ?>
        <tr>
            <td><?= htmlspecialchars($nombres[$i]) ?></td>
            <td><?= $notas[$i] ?></td>
        </tr>
    <?php endfor; ?>
</table>
```


Con echo:

```php

echo '<table border="1">';
echo '<tr><th>Alumno</th><th>Nota</th></tr>';

for ($i = 0; $i < count($nombres); $i++) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($nombres[$i]) . '</td>';
    echo '<td>' . $notas[$i] . '</td>';
    echo '</tr>';
}

echo '</table>';
```


Cuándo usar cada uno:

- foreach: recorrer elementos de un array.

- for: recorrer posiciones mediante un contador, normalmente $i.

## 6. Mostrar elementos seleccionados por el usuario

Muy habitual en formularios con checkbox, opciones múltiples o complementos.

PHP:
```php

$complementos = ["Funda", "Cargador", "Ratón"];

$extras = [
    "Funda" => ["nombre" => "Funda protectora", "precio" => 10],
    "Cargador" => ["nombre" => "Cargador rápido", "precio" => 20],
    "Ratón" => ["nombre" => "Ratón inalámbrico", "precio" => 15]
];
```

Mostrar solo los nombres

```html
<p>Complementos seleccionados:</p>

<?php if (empty($complementos)): ?>
    <p>No has seleccionado ningún complemento.</p>
<?php else: ?>
    <?php foreach ($complementos as $extra): ?>
        <p><?= htmlspecialchars($extras[$extra]['nombre']) ?></p>
    <?php endforeach; ?>
<?php endif; ?>
```

Mostrar los nombres y los precios en una tabla

```php
<?php if (empty($complementos)): ?>
    <p>No has seleccionado complementos.</p>
<?php else: ?>

    <table border="1">
        <tr>
            <th>Complemento</th>
            <th>Precio</th>
        </tr>

        <?php foreach ($complementos as $extra): ?>
            <tr>
                <td><?= htmlspecialchars($extras[$extra]['nombre']) ?></td>
                <td>
                    <?= number_format($extras[$extra]['precio'], 2, ',', '.') ?> €
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php endif; ?>
```


Patrón que debes aprender:

```php
if (empty($array)) {
    // No hay elementos.
} else {
    foreach ($array as $elemento) {
        // Mostrar cada elemento.
    }
}
```


Si las claves proceden de datos del usuario, comprueba que existen en el array antes de utilizarlas.

## 7. Mostrar una lista con ul y li

Para mostrar elementos sin necesidad de una tabla.

Lista con foreach

```php
<ul>
    <?php foreach ($productos as $producto): ?>
        <li><?= htmlspecialchars($producto['nombre']) ?></li>
    <?php endforeach; ?>
</ul>
```

Lista con echo

```php
echo '<ul>';

foreach ($productos as $producto) {
    echo '<li>' . htmlspecialchars($producto['nombre']) . '</li>';
}

echo '</ul>';
```

Lista numerada

```php
<ol>
    <?php foreach ($frutas as $fruta): ?>
        <li><?= htmlspecialchars($fruta) ?></li>
    <?php endforeach; ?>
</ol>
```

## 8. Mostrar condiciones dentro de una tabla

Ejemplo: mostrar si un producto tiene stock.

```html
<table border="1">
    <tr>
        <th>Producto</th>
        <th>Stock</th>
        <th>Estado</th>
    </tr>

    <?php foreach ($productos as $producto): ?>
        <tr>
            <td><?= htmlspecialchars($producto['nombre']) ?></td>
            <td><?= (int)$producto['stock'] ?></td>
            <td>
                <?php if ($producto['stock'] > 0): ?>
                    Disponible
                <?php else: ?>
                    Agotado
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
```


También puedes utilizar if, elseif y else:

```php
<?php if ($nota >= 9): ?>
    Sobresaliente
<?php elseif ($nota >= 5): ?>
    Aprobado
<?php else: ?>
    Suspenso
<?php endif; ?>
```

## 9. Mostrar importes y totales
Formatear un importe
```php
<?= number_format($precio, 2, ',', '.') ?> €
```


Ejemplo: 1234.5 se muestra como 1.234,50 €.

Mostrar un resumen
```html
<div class="total">
    <p>Precio unitario: <?= number_format($precio, 2, ',', '.') ?> €</p>
    <p>Cantidad: <?= (int)$cantidad ?></p>
    <p>Subtotal: <?= number_format($subtotal, 2, ',', '.') ?> €</p>
    <p>Descuento: <?= number_format($descuento, 2, ',', '.') ?> €</p>
    <p>IVA: <?= number_format($importeIVA, 2, ',', '.') ?> €</p>
    <h2>Total: <?= number_format($totalFinal, 2, ',', '.') ?> €</h2>
</div>
```

El mismo resumen con echo

```php
echo '<div class="total">';

echo '<p>Precio unitario: '
    . number_format($precio, 2, ',', '.') . ' €</p>';

echo '<p>Cantidad: ' . (int)$cantidad . '</p>';

echo '<p>Subtotal: '
    . number_format($subtotal, 2, ',', '.') . ' €</p>';

echo '<p>Descuento: '
    . number_format($descuento, 2, ',', '.') . ' €</p>';

echo '<p>IVA: '
    . number_format($importeIVA, 2, ',', '.') . ' €</p>';

echo '<h2>Total: '
    . number_format($totalFinal, 2, ',', '.') . ' €</h2>';

echo '</div>';
```


Consejo: calcula los importes en PHP antes de mostrarlos. El HTML debería encargarse principalmente de presentar los resultados.

## 10. Mostrar un resumen con una tabla de dos columnas

Ideal para tickets y presupuestos.

```html
<table border="1">
    <tr>
        <th>Concepto</th>
        <th>Importe</th>
    </tr>

    <tr>
        <td>Subtotal</td>
        <td><?= number_format($subtotal, 2, ',', '.') ?> €</td>
    </tr>

    <tr>
        <td>Descuento</td>
        <td><?= number_format($descuento, 2, ',', '.') ?> €</td>
    </tr>

    <tr>
        <td>Transporte</td>
        <td><?= number_format($transporte, 2, ',', '.') ?> €</td>
    </tr>

    <tr>
        <td>IVA</td>
        <td><?= number_format($importeIVA, 2, ',', '.') ?> €</td>
    </tr>

    <tr>
        <th>Total final</th>
        <th><?= number_format($totalFinal, 2, ',', '.') ?> €</th>
    </tr>
</table>
```

## 11. Recorrer elecciones del usuario y buscar sus precios

Cuando tienes un array con las elecciones y otro array con los precios.

PHP:

```php
$elecciones = ["Rojo", "Grande", "Premium"];

$componentes = [
    "Color" => ["Rojo" => 10, "Azul" => 12],
    "Tamaño" => ["Grande" => 20, "Pequeño" => 15],
    "Acabado" => ["Premium" => 30, "Básico" => 10]
];

$claves = ["Color", "Tamaño", "Acabado"];
```


HTML + PHP:

```html
<table border="1">
    <tr>
        <th>Característica</th>
        <th>Elección</th>
        <th>Precio</th>
    </tr>

    <?php for ($i = 0; $i < count($elecciones); $i++): ?>
        <?php
            $clave = $claves[$i];
            $eleccion = $elecciones[$i];
            $precio = $componentes[$clave][$eleccion];
        ?>

        <tr>
            <td><?= htmlspecialchars($clave) ?></td>
            <td><?= htmlspecialchars($eleccion) ?></td>
            <td><?= number_format($precio, 2, ',', '.') ?> €</td>
        </tr>
    <?php endfor; ?>
</table>
```


Qué hace cada variable:

```php
$i: posición actual.
$clave: categoría del componente.
$eleccion: opción elegida.
$precio: precio obtenido del array multidimensional.
```

Si las elecciones pueden contener valores no válidos, verifica que existan las claves antes de acceder a ellas.

## 12. Crear un bloque HTML con CSS

Puedes reutilizar esta estructura para presupuestos, tickets o resultados de formularios.

HTML
```html
<style>
    .resultado {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background: white;
        border-radius: 10px;
    }

    .resultado table {
        width: 100%;
        border-collapse: collapse;
    }

    .resultado th,
    .resultado td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .resultado th {
        background: #e2e8f0;
    }

    .total {
        margin-top: 20px;
        padding: 15px;
        background: #ecfdf5;
    }
</style>

<div class="resultado">
    <h1>Resultado del pedido</h1>

    <!-- Aquí puedes insertar cualquiera de las tablas anteriores. -->

    <div class="total">
        <h2>Total: <?= number_format($totalFinal, 2, ',', '.') ?> €</h2>
    </div>
</div>
```

Este fragmento es solo la parte visual; no necesitas repetir el documento HTML entero.

## 13. Plantilla para construir una tabla desde cero

Cuando en un examen te pidan mostrar un array en una tabla, puedes partir de este patrón.

```php
<table border="1">
    <tr>
        <th>COLUMNA 1</th>
        <th>COLUMNA 2</th>
        <th>COLUMNA 3</th>
    </tr>

    <?php foreach ($array as $elemento): ?>
        <tr>
            <td><?= htmlspecialchars($elemento['campo1']) ?></td>
            <td><?= htmlspecialchars($elemento['campo2']) ?></td>
            <td><?= htmlspecialchars($elemento['campo3']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
```

Debes adaptar:

```php
$array: nombre del array que quieres recorrer.
$elemento: variable que representa cada elemento.
campo1, campo2 y campo3: claves reales del array.
Los encabezados <th>: nombres de las columnas.
14. Errores típicos en los exámenes
Error 1: olvidar concatenar en echo
```

Incorrecto:

```php
echo '<p>$nombre</p>';
```

Correcto:

```php
echo '<p>' . htmlspecialchars($nombre) . '</p>';
```

Error 2: confundir clave y valor
```php
foreach ($precios as $producto => $precio) {
    // $producto es la clave.
    // $precio es el valor.
}
```

Error 3: olvidar las etiquetas de fila

Cada elemento de una tabla debe generar su propia fila:

```php
foreach ($productos as $producto) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($producto['nombre']) . '</td>';
    echo '</tr>';
}
```

Error 4: no comprobar si un array está vacío
```php
if (empty($complementos)) {
    echo '<p>No hay complementos seleccionados.</p>';
} else {
    // Recorrer el array.
}
```

Error 5: no escapar el texto

Para mostrar texto procedente de formularios o de otras fuentes, utiliza:

```php
htmlspecialchars($texto, ENT_QUOTES, 'UTF-8')
```

Esto ayuda a evitar que el texto se interprete como HTML. No sustituye la validación de los datos ni las consultas preparadas para bases de datos.

Error 6: olvidar cerrar los bloques alternativos

Con sintaxis alternativa de PHP:

```php
<?php if ($condicion): ?>
    <!-- HTML -->
<?php else: ?>
    <!-- Otro HTML -->
<?php endif; ?>
```

Y con foreach:

```php
<?php foreach ($array as $elemento): ?>
    <!-- HTML -->
<?php endforeach; ?>
```

## 15. Resumen rápido para memorizar

```php
Lo que necesitas	Estructura
Mostrar una variable	<?= $variable ?>
Mostrar texto de forma segura	<?= htmlspecialchars($texto) ?>
Mostrar un precio	<?= number_format($precio, 2, ',', '.') ?>
Recorrer un array	foreach ($array as $elemento)
Recorrer clave y valor	foreach ($array as $clave => $valor)
Recorrer posiciones	for ($i = 0; $i < count($array); $i++)
Comprobar si está vacío	empty($array)
Condición dentro del HTML	if (...): ... else: ... endif;
Repetir HTML	foreach (...): ... endforeach;
Generar HTML desde PHP	echo '<p>' . $variable . '</p>';
Regla final
Si el ejercicio tiene mucho HTML, normalmente resulta más cómodo cerrar PHP y escribir las etiquetas HTML directamente.
Si el ejercicio pide generar el documento mediante echo, construye cada fragmento concatenando el HTML y las variables.
Si hay una colección de datos, piensa en foreach.
Si tienes varios arrays relacionados por posiciones, piensa en for.
Si hay opciones que pueden estar vacías, piensa en empty().
Si muestras importes, utiliza number_format().
Si muestras texto externo, utiliza htmlspecialchars().
```