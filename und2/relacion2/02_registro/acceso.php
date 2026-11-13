<?php

declare(strict_types=1);
require_once __DIR__ . '/cuentas.php';
// TODO: iniciar sesión y tramitar el formulario por POST.
session_start();

if (isset($_SESSION['nombre'])) {
    header('Location: panel.php');
    exit;
}

// evita un warnnig si $_SESSION['bloqueado_hasta'] ?? 0 aún no existe al hacer la comprobacion
$bloqueadoHasta = $_SESSION['bloqueado_hasta'] ?? 0;
// comprobar si sesion tiene bloqueo
if ($bloqueadoHasta > 0 && time() >= $bloqueadoHasta) {
    $_SESSION['intentos'] = 0;
    $_SESSION['bloqueado_hasta'] = 0;
    $bloqueadoHasta = 0;
}

// TODO: verificar credenciales 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && time() >= $bloqueadoHasta) {
    $email = strtolower(trim($_POST['correo']));
    $password = (string) $_POST['pass'] ?? "";

    $cuentas = obtenerCuentas();
    if (!isset($cuentas[$email])) {
        $nombre = null;
    } else {
        if (!password_verify($password, $cuentas[$email]['hash'])) {
            $nombre = null;
        } else {
            $nombre = $cuentas[$email]['nombre'];
        }
    }


    // TODO: gestionar los intentos fallidos y el bloqueo de 90 segundos.
    $_SESSION['intentos'] = $_SESSION['intentos'] ?? 0;

    // Si las credenciales son incorrectas
    if ($nombre === null) {
        $_SESSION['intentos']++;

        if ($_SESSION['intentos'] >= 3) {
            $_SESSION['bloqueado_hasta'] = time() + 90;
            $bloqueadoHasta = $_SESSION['bloqueado_hasta'];
        }
    } else {
        // TODO: regenerar el ID y guardar el inicio.
        session_regenerate_id(true);
        $_SESSION['nombre'] = $nombre;
        $_SESSION['correo'] = $email;
        $_SESSION['ultimoAcceso'] = time();
        $_SESSION['movimientos'] = [];
        $_SESSION['intentos'] = 0;
        $_SESSION['bloqueado_hasta'] = 0;
        header('Location: panel.php');
        exit;
    }
}

$errorExpirada = "";
if (($_GET['motivo'] ?? '') === 'expirada') {
    $errorExpirada = "Sesion expirada pasados 180 segundos";
}

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
    <?php if ($bloqueadoHasta - time() > 0): ?>
        <p>
            Acceso bloqueado.
            Debes esperar <?= $bloqueadoHasta - time() ?> segundos.
        </p>
    <?php endif; ?>
    <h2><?= $errorExpirada ?></h2>

    <p>Intentos fallidos: <?= $_SESSION['intentos'] ?? 0 ?></p>
    <form action="acceso.php" method="post">
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