<?php

declare(strict_types=1);

class EquipoRepositorio
{
    public function __construct(private PDO $pdo) {}

    // Recupera los equipos en orden alfabético.
    public function listar(): array
    {
        return $this->pdo
            ->query('SELECT * FROM equipo ORDER BY id DESC')
            ->fetchAll();
    }

    public function crear(string $nombre, int $unidades): void
    {
        $nombre = trim($nombre);
        if (!filter_var($unidades, FILTER_VALIDATE_INT) || $nombre === '' || strlen($nombre) > 80 ) {
            throw new InvalidArgumentException('Datos incorrectos; nombre de al menos 8 caracteres.');
        }
        $sql = 'INSERT INTO usuario(nombre, unidades) VALUES (?, ?)';
        $sentencia = $this->pdo->prepare($sql);
        $sentencia->execute([$nombre, $unidades]);
    }

    public function actualizarUnidades(int $id, int $unidades): void
    {
        // Comprueba el equipo y actualiza las unidades.
    }

    public function eliminar(int $id): void
    {
        // Comprueba el equipo y elimínalo.
    }
}


