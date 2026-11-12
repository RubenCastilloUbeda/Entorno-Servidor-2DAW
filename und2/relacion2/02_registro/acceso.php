<?php

declare(strict_types=1);
require_once __DIR__ . '/cuentas.php';
// TODO: iniciar sesión y tramitar el formulario por POST.
session_start();

if (isset($_SESSION['nombre'])) {
    header('Location: panel.php');
    exit;
}

if (time() < $_SESSION['bloqueado_hasta']) {
    exit;
}

// TODO: verificar credenciales 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim((string) $_POST['correo'] ?? null);
    $password = (string) $_POST['pass'] ?? "";

    $cuentas = obtenerCuentas();
    if (!isset($cuentas[$email])) {
        $nombre = null;
    }

    if (!password_verify($password, $cuentas[$email]['hash'])) {
        $nombre = null;
    } else {
        $nombre = $cuentas[$email]['nombre'];
    }
}

// comprobar y aumentar intentos 
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $nombre === null || $email === null) {
    if ($_SESSION['intentos']<3) {
        $_SESSION['intentos']+=1;
    } else {
        $_SESSION['bloqueado_hasta']=time()+90;
    } 
}

// TODO: regenerar el ID y guardar el inicio.
if ($nombre !== null) {
    session_regenerate_id(true);
    $_SESSION['nombre'] = $nombre;
    $_SESSION['correo'] = $email;
    $_SESSION['tiempo'] = time();
    $_SESSION['movimientos'] = [];
    $_SESSION['intentos'] = 0;
    $_SESSION['bloqueado_hasta'] = null;
    header('Location: panel.php');
    exit;
}

// TODO: gestionar los intentos fallidos y el bloqueo de 90 segundos.





?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Registro de turnos</title>
</head>

<body>
    <h1>Identificación</h1>
    <!-- TODO: avisos, bloqueo y formulario de acceso. -->
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