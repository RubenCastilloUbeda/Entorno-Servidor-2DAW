<?php
namespace App\excepciones;

class StockInsuficienteException extends RuntimeException{
    
public function mensajePersonalizado()
    {
        return "Error de Stock: " . $this->getMessage();
    }
}
