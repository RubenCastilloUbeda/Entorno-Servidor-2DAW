<?php
namespace App\dominio;
use App\excepciones\StockInsuficienteException;

class Articulo
{
    public function __construct(private string $codigo, private string $nombre, private int $stock)
    {

        if (trim($codigo) == "" || $nombre == "" || $stock <=0) {
            throw new \InvalidArgumentException("Alguno de los parametros es incorrecto");
        }
    }

    public function aumentarStock(int $cantidad) : int {
        if ($cantidad<=0) {
            throw new \InvalidArgumentException("Cantidad no puede ser igual o menor de 0");
        } else {
            $this->stock+$cantidad;
        }
        return $this->stock;
    }

    public function retirarStock(int $cantidad) : int{
        if ($this->stock <=0) {
            throw new \InvalidArgumentException("Stock a 0 actualmente");
        } 
        if ($cantidad > $this->stock) {
            throw new StockInsuficienteException("Cantidad a retirar:" . $cantidad . " ,mayor que stock actual:" . $this->stock  );
        }
        return $this->stock -= $cantidad;
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

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }
}
