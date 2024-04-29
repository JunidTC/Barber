<?php

class Factura{



    private $facturaId;
    private $clienteId;
    private $impuestoVenta;
    private $montoTotal;
    private $monto;
    private $fecha;
    private $activo;
    private $metodoPago;



    // contructor

    function __construct($facturaId,$clienteId,$impuestoVenta,$montoTotal,$monto,$fecha,$activo,$metodoPago){

        $this->facturaId = $facturaId;
        $this->clienteId = $clienteId;
        $this->impuestoVenta = $impuestoVenta;
        $this->montoTotal = $montoTotal;
        $this->monto = $monto;
        $this->fecha = $fecha;
        $this->activo = $activo;
        $this->metodoPago = $metodoPago;

    }


    //gets and sets

    

    function getFacturaId()
    {
        return $this->facturaId;
    }   

    function setFacturaId($facturaId)
    {
        $this->facturaId = $facturaId;
    }



    function getClienteId()
    {
        return $this->clienteId;
    }




    function setClienteId($clienteId)
    {
        $this->clienteId = $clienteId;
    }



    function getImpuestoVenta()
    {
        return $this->impuestoVenta;
    }


    function setImpuestoVenta($impuestoVenta)
    {
        $this->impuestoVenta = $impuestoVenta;
    }


    function getMontoTotal()
    {
        return $this->montoTotal;
    }


    function setMontoTotal($montoTotal)
    {
        $this->montoTotal = $montoTotal;
    }


    function getMonto()
    {
        return $this->monto;
    }


    function setMonto($monto)
    {
        $this->monto = $monto;
    }




    function getFecha()
    {
        return $this->fecha;
    }


    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }


    function getActivo()
    {
        return $this->activo;
    }


    function setActivo($activo)
    {
        $this->activo = $activo;
    }


    function getMetodoPago()
    {
        return $this->metodoPago;
    }

    
    function setMetodoPago($metodoPago)
    {
        $this->metodoPago = $metodoPago;
    }

}
