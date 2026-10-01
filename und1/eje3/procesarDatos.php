<?php
/* Primero: comprobar metodo POST o GET 
    Segundo: recoger datos del formulario y guardarlo en las variables
    Tercero: hacer comprobaciones de cada una de las variables
    Cuarto:hacer variables con arrays de los datos que debe tener el formulario (para evitar hackeos es una buena práctica)
    Quinto:crear el html pero dentro de la etiqueta <?php mostrando los resultados con echo 
    Buena práctica crear funciones que hagan comprobaciones */

    $apellidos = $_POST["apellidos"];
    $peso = $_POST["peso"];
    $sexo = $_POST["sexo"];
    $estadoCivil = $_POST["estado-civil"];
    $aficiones = $_POST["aficiones"];


// <!DOCTYPE html>
// <html lang="en">
// <head>
//     <meta charset="UTF-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <title>Document</title>
// </head>
// <body>
//     <h1><?= $nombre <?= $apellidos</h1>
//     <div>
//         <p>Edad:  $edad</p>
//         <p>Sexo:  $sexo</p>
//         <p>Peso:  $peso</p>
//         <ul>
//             <?php  foreach ($aficiones as $aficion) {
//                 echo "<li> $aficion </li>";
//             } 
//
//         </ul>
//     </div>
// </body>
// </html>
