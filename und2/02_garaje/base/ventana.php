<?php

class ventana{
    private $abierta;

    public function __construct($abierta){
        $this->$abierta=false;
    }

    public function abrirVentana() {
        if (!$this->getAbierta()) {
            return $this->setAbierta(true);
        }
        return $this->getAbierta();
    }

    public function cerrarVentana(){
        if ($this->getAbierta()) {
            return $this->setAbierta(false);
        }
        return $this->getAbierta();
    }

    /**
     * Get the value of abierta
     */ 
    public function getAbierta(){
        return $this->abierta;
    }

    /**
     * Set the value of abierta
     *
     * @return  self
     */ 
    public function setAbierta($abierta){
        $this->abierta = $abierta;

        return $this;
    }

}