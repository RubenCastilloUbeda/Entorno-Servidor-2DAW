<?php
declare(strict_types=1);
// TODO: aceptar solo POST.
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método no permitido.');
}
// TODO: cerrar por completo la sesión y caducar la cookie.
// Vaciar los datos de la sesión
$_SESSION = [];

// Eliminar la cookie de sesión del navegador
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
// TODO: redirigir a acceso.php.
header('Location: acceso.php');
exit;
