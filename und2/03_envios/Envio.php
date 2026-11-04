<?php
abstract class Envio { 
/* TODO: constructor con peso positivo y calcularPrecio abstracto */ 

    protected $pesoKg;
    private $codigo;

    public function __construct($pesoKg) {
        $this->setPesoKg($pesoKg);
    }

    abstract public function calcularPrecio() :float;

    /**
     * Get the value of pesoKg
     */ 
    public function getPesoKg()
    {
        return $this->pesoKg;
    }

    /**
     * Set the value of pesoKg
     *
     * @return  self
     */ 
    public function setPesoKg($pesoKg)
    {
        if ($pesoKg>0) {
            $this->pesoKg = $pesoKg;
        }

        return $this;
    }

    /**
     * Get the value of codigo
     */ 
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */ 
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }
}