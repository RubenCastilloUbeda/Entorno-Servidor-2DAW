<?php

/* Comprueba que la peticion del formulario se hace con POST, en caso de que no muestra el mensaje
    http_response_code(405), muestra ese error por consola para que sea mas sencillo saber el error
*/
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    exit('Envía el formulario mediante POST.');
}

/* Mostrar datos de string de forma segura, evita que puedas colar codigo o cosas similares en formularios ya que 
capa los caracteres que puedes usar 
$valor = es la variable que queremos comprobar */
htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');

// validar texto cogiendo claves de un array ya creado
$modelo = $_POST["Modelo"] ?? "";
if (!array_key_exists($modelo, $componentes["Modelo"])) {
    exit("No has seleccionado ninguna opcion valida.");
}

// validar un array con checkbox seleccionas varias opciones
$accesorios = $_POST["Accesorios"] ?? [];
if ($accesorios == []) {
    echo "Ningun accesorio seleccionado";
} else {
    foreach ($accesorios as $accesorio) {
        if (!array_key_exists($accesorio, $componentes["Accesorios"])) {
            echo "No has seleccionado ningun accesorio valido.";
        }
    }
}

// filtrar una cantidad
$cantidad = filter_var($_POST['numeroDePreguntas'] ?? null,
    FILTER_VALIDATE_INT,
    ['options' => ['min_range' => 1, 'max_range' => 5]]
);

// un campo que puede usarse o no 
$codigoDescuento = $_POST["codigo_descuento"] ?? "";
if ($codigoDescuento == "") {
    echo "No utilizaste ningun codigo de descuento";
} else {
    if (!array_key_exists($codigoDescuento, $codigosDescuento)) {
        exit ("No has seleccionado un codigo de descuento valido.");
    } else {
        $cantidadDescuento = $codigosDescuento[$codigoDescuento];
    }
}

// seleccionar aleatorias de un array
$seleccionadas = (array) array_rand($repositorioPreguntas[$asignatura], $cantidad);