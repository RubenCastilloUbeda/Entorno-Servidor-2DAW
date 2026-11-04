<?php
require_once __DIR__ . "/puerta.php";

class coche{
    private string $modelo;
    private array $puertas=[];

    public function __construct($puertas){
        $this->puertas=$puertas;
    }

    public function abrirPuerta($indice){
        foreach ($this->puertas as $p) {
            if ($p->getIndice()==$indice) {
                $p->abrirPuerta();
            }
        }
    }

    public function cerraTodo(){
        foreach ($this->puertas as $p) {
            if ($p->getAbierta()) {
                $p->setAbierta(false);
            }
        }
    }

    public function numeroPuertasAbiertas(){
        $contador=0;
        foreach ($this->puertas as $p) {
            if ($p->getAbierta()) {
                $contador++;
            }
        }
        return $contador;
    }

    public function resumen(): string {
        $puertasAbiertas = $this->numeroPuertasAbiertas();
        return "El coche tiene " . count($this->puertas) . " puertas totales de las cuales estan abiertas $puertasAbiertas";
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

    /**
     * Get the value of modelo
     */ 
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set the value of modelo
     *
     * @return  self
     */ 
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }
}