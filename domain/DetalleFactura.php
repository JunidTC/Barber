<?php

class DetalleFactura{

    private $idDetalleFactura;
    private $facturaId;
    private $servicioId;
    private $cantidadServicio;
    private $activo;
    function __construct($facturaId,$servicioId, $cantidadServicio, $idDetalleFactura  , $activo ) {
        $this->facturaId = $facturaId;
        $this->servicioId = $servicioId;
        $this->cantidadServicio = $cantidadServicio;
        $this->idDetalleFactura = $idDetalleFactura;
        $this->activo = $activo;

    }

    function getActivo()
    {
        return $this->activo;
    }

    function setActivo($activo)
    {
        $this->activo = $activo;
    }

    function getIdDetalleFactura() {
        return $this->idDetalleFactura;
    }
    
    function setIdDetalleFactura($idDetalleFactura) {
        $this->idDetalleFactura = $idDetalleFactura;
    }

    function getFacturaId()
    {
        return $this->facturaId;
    }

    function setFacturaId($facturaId)
    {
        $this->facturaId = $facturaId;
    }

    function getServicioId()
    {
        return $this->servicioId;
    }

    function setServicioId($servicioId)
    {
        $this->servicioId = $servicioId;
    }


    function getCantidadServicio()
    {
        return $this->cantidadServicio;
    }

    function setCantidadServicio($cantidadServicio)
    {
        $this->cantidadServicio = $cantidadServicio;
    }

    






}


?>