<?php
declare(strict_types=1);
// TODO: rechazar los métodos distintos de POST con HTTP 405.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método no permitido.');
}
// TODO: abrir la sesión, vaciar sus datos, caducar su cookie y destruirla.
session_start();

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
header('Location: login.php');
exit;