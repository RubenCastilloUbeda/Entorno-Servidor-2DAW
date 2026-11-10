<?php

declare(strict_types=1);
require_once __DIR__ . '/usuarios.php';

// TODO: iniciar o recuperar la sesión.
session_start();

// TODO: si el usuario ya está identificado, redirigir a panel.php.
if (isset($_SESSION['nombre'])) {
    header('Location: panel.php');
    exit;
    }
    
    
    $error = '';

// TODO: validar las credenciales recibidas por POST.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim((string) $_POST["correo"]) ?? "";
        $password = (string) $_POST["pass"] ?? "";
        
        $nombre=autenticarNombre($email,$password);
        $perfil=autenticarPerfil($email,$password);

// TODO: regenerar el ID, guardar los datos necesarios y redirigir.
    if ($nombre !== null) {
        session_regenerate_id(true);
        $_SESSION['nombre'] = $nombre;
        $_SESSION['correo'] = $email;
        $_SESSION['perfil'] = $perfil;
        header('Location: panel.php');
        exit;
    }
    $error = 'Datos de acceso incorrectos.';
}


?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Acceso a incidencias</title>
</head>

<body>
    <h1>Acceso al panel de incidencias</h1>
    <!-- TODO: mostrar errores y el formulario con correo y contraseña. -->
    <form action="login.php" method="post">
        <label for="correo">Correo
            <input type="email" name="correo" id="correo">
        </label>
        <label for="pass">Contraseña
            <input type="password" name="pass" id="pass">
        </label>
        <button type="submit">Entrar</button>
    </form>
</body>

</html>