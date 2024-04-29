<?php
class ImpuestoVenta{
    public $idimpuestoventa;
    public $porcentaje;
    public $fechaactualizacion;
    public $activo;
 
    function __construct($idimpuestoventa,$porcentaje,$fechaactualizacion,$activo){
        $this->idimpuestoventa = $idimpuestoventa;
        $this->porcentaje = $porcentaje;
        $this->fechaactualizacion = $fechaactualizacion;
        $this->activo = $activo;
    }

    function getIdImpuestoVenta()
    {
        return $this->idimpuestoventa;
    }

    function setIdImpuestoVenta($idimpuestoventa)
    {
        $this->idimpuestoventa = $idimpuestoventa;
    }

    function getPorcentaje()
    {
        return $this->porcentaje;
    }

    function setPorcentaje($porcentaje)
    {
        $this->porcentaje = $porcentaje;
    }

    function getFechaActualizacion()
    {
        return $this->fechaactualizacion;
    }

    function setFechaActualizacion($fechaactualizacion)
    {
        $this->fechaactualizacion = $fechaactualizacion;
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
