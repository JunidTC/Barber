<?php
class MetodoPago
{
    public $idmetodopago;
    public $nombre;
    public $descripcion;
    public $activo;

    function __construct($idmetodopago, $nombre, $descripcion, $activo)
    {
        $this->idmetodopago = $idmetodopago;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->activo = $activo;
    }

    //sets y gets

    function getId()
    {
        return $this->idmetodopago;
    }

    function setId($idmetodopago)
    {
        $this->idmetodopago = $idmetodopago;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function getActivo()
    {
        return $this->activo;
    }

    function setActivo($activo)
    {
        $this->activo = $activo;
    }
}
