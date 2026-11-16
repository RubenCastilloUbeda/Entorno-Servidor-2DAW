<?php

declare(strict_types=1);
require_once __DIR__ . '/preguntas.php';
// TODO: iniciar sesión y tratar POST de inicio de cuestionario.
// TODO: mostrar inicio, pregunta actual o resultados según el estado.
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['alias'] = $_POST['alias'] ?? null;
    $_SESSION['cuestionario'] = null;
    $_SESSION['preguntaActual'] = 0;
    $_SESSION['aciertos'] = 0;
}

$terminado = isset($_SESSION['cuestionario']) && $_SESSION['preguntaActual'] >= count($preguntas);

?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Cuestionario</title>
</head>


<body>
    <h1>Cuestionario por sesiones</h1>

    <?php if (!isset($_SESSION['alias'])): ?>
        <form action="index.php" method="post">
            <label for="alias">Alias
                <input type="text" name="alias" id="alias" minlength="2" maxlength="30" required>
            </label>
            <button type="submit">Comenzar</button>
        </form>

    <?php elseif ($terminado): ?>

    <?php else: ?>
        <h2>Pregunta</h2>
        <h2>Alias: <?= htmlspecialchars($_SESSION['alias']) ?> </h2>
        <p>Nota:<?= (int) $_SESSION['aciertos'] ?> / 4</p>
        <p><?= htmlspecialchars($preguntas[$_SESSION['preguntaActual']]['texto']) ?></p>
        <form action="responder.php" method="post">
            <?php foreach ($preguntas[$_SESSION['preguntaActual']]['opciones'] as $indice => $opcion): ?>
                <label>
                    <input type="radio" name="respuesta" value="<?= $indice ?>" required> <?= htmlspecialchars($opcion) ?>
                </label>
            <?php endforeach; ?>
            <br>
            
            <button type="submit">Responder</button>
        </form>
    <?php endif; ?>
    <?php if (isset($_SESSION['alias'])): ?>
        <form action="reiniciar.php" method="post">
            <button type="submit">Reiniciar</button>
        </form>
    <?php endif; ?>
</body>
</html>