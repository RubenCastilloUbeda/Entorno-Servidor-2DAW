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