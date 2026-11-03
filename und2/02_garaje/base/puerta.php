<?php
require_once __DIR__ . "/ventana.php";

class puerta{
    private $abierta;

    
    /**
     * Get the value of abierta
     */ 
    public function getAbierta()
    {
        return $this->abierta;
    }

    /**
     * Set the value of abierta
     *
     * @return  self
     */ 
    public function setAbierta($abierta)
    {
        $this->abierta = $abierta;

        return $this;
    }
}