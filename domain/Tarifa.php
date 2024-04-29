<?php

class Tarifa
{
    private $idtarifa;
    private $fechamodificada;
    private $monto;
    private $activo;


    function __construct($idtarifa,$fechamodificada,$monto,$activo){
        $this->idtarifa = $idtarifa;
        $this->fechamodificada = $fechamodificada;
        $this->monto = $monto;
        $this->activo = $activo;
    }


    function getIdTarifa()
    {
        return $this->idtarifa;
    }
    function setIdTarifa($idtarifa)
    {
        $this->idtarifa = $idtarifa;
    }
    function getFechaModificada()
    {
        return $this->fechamodificada;
    }
    function setFechaModificada($fechamodificada)
    {
        $this->fechamodificada = $fechamodificada;
    }
    function getMonto()
    {
        return $this->monto;
    }
    function setMonto($monto)
    {
        $this->monto = $monto;
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
