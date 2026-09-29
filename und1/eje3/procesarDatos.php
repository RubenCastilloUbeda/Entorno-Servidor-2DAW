<?php
$nombre = $_POST["nombre"];
echo "Hola, " . htmlspecialchars($nombre, ENT_QUOTES, "UTF-8");
?>