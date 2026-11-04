<?php
require_once __DIR__ . "/ventana.php";

class puerta{
    private $abierta;
    private $indice;

    public function __construct($abierta){
        $this->$abierta=false;
    }

    public function abrirPuerta()
    {
        if (!$this->getAbierta()) {
            return $this->setAbierta(true);
        }
        return $this->getAbierta();
    }

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

    /**
     * Get the value of indice
     */ 
    public function getIndice()
    {
        return $this->indice;
    }

    /**
     * Set the value of indice
     *
     * @return  self
     */ 
    public function setIndice($indice)
    {
        $this->indice = $indice;

        return $this;
    }
}
