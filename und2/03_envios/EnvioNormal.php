<?php
require_once __DIR__ . "/Envio.php";
class EnvioNormal extends Envio { 

    #[Override]
    public function calcularPrecio(): float
    {
        $precio = 4 + (1.50*$this->pesoKg);
        return $precio;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    }