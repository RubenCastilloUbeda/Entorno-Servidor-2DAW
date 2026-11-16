<?php
declare(strict_types=1);
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); 
    exit;
}

// TODO: iniciar sesión, eliminar solo el estado del cuestionario y redirigir.
session_unset();
// unset($_SESSION['cuestionario']);

header('Location: index.php');
exit;
