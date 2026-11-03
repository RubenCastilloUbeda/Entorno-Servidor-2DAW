<?php
require_once __DIR__ . "/puerta.php";

class coche{
    private $puertas=[];

    public function __construct($puertas){
        $this->puertas;
    }

    /**
     * Get the value of puertas
     */ 
    public function getPuertas(){
        return $this->puertas;
    }

    /**
     * Set the value of puertas
     *
     * @return  self
     */ 
    public function setPuertas($puertas){
        $this->puertas = $puertas;

        return $this;
    }
}