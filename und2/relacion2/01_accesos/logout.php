<?php
declare(strict_types=1);
// TODO: rechazar los métodos distintos de POST con HTTP 405.
// TODO: abrir la sesión, vaciar sus datos, caducar su cookie y destruirla.



session_start();

session_unset();
// TODO: redirigir a login.php.
session_destroy();
header('Location: login.php');
exit;