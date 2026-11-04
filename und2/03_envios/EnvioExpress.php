<?php
require_once __DIR__ . "/Envio.php";

/* TODO: extends Envio implements Rastreable */

final class EnvioExpress extends Envio implements Rastreable
{

    public function __construct(float $pesoKg, private string $codigo)
    {
        parent::__construct($pesoKg);
    }

    #[Override]
    public function calcularPrecio(): float
    {
        return 9 + (2.75 * $this->pesoKg);
    }

    #[Override]
    public function codigoSeguimiento(): string
    {
        return $this->codigo();
    }
}
