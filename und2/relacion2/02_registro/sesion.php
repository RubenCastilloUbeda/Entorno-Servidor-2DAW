<?php
declare(strict_types=1);
// TODO: escribir una función reutilizable que verifique la sesión.
// Debe comprobar usuario y límite de inactividad de 180 segundos.
// Si sigue vigente, actualizar la hora de la última actividad.
// Si ha expirado, cerrar la sesión y redirigir al acceso.

function comprobarSesion() {
    session_start();

    if (!isset($_SESSION['nombre'])) {
        header('Location: acceso.php');
        exit;
    }

    // Comprobar si han pasado más de 180 segundos
    if (time() - ($_SESSION['ultimoAcceso'] ?? 0) > 180) {

        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(session_name(), '', [
                'expires' => time() - 3600,
                'path' => $params['path'],
                'domain' => $params['domain'],
                'secure' => $params['secure'],
                'httponly' => $params['httponly'],
                'samesite' => $params['samesite']
            ]);
        }
        
        session_destroy();

        header('Location: acceso.php?motivo=expirada');
        exit;
    }

    // Si no ha caducado, actualizar la última actividad
    $_SESSION['ultimoAcceso'] = time();
}


