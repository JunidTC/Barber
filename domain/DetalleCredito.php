<?php


class DetalleCredito{

    private $nombreCliente;
    private $fechaFactura;
    private $montoCredito;
    private $fechaLimite;
    private $facturaId;
    private $creditoId;

    //constructor
    public function __construct($nombreCliente, $fechaFactura, $montoCredito, $fechaLimite, $facturaId, $creditoId) {
        $this->nombreCliente = $nombreCliente;
        $this->fechaFactura = $fechaFactura;
        $this->montoCredito = $montoCredito;
        $this->fechaLimite = $fechaLimite;
        $this->facturaId = $facturaId;
        $this->creditoId = $creditoId;
    }

    //setters
    public function setNombreCliente($nombreCliente) {
        $this->nombreCliente = $nombreCliente;
    }

    public function setFechaFactura($fechaFactura) {
        $this->fechaFactura = $fechaFactura;
    }

    public function setMontoCredito($montoCredito) {
        $this->montoCredito = $montoCredito;
    }

    public function setFechaLimite($fechaLimite) {
        $this->fechaLimite = $fechaLimite;
    }

    public function setFacturaId($facturaId) {
        $this->facturaId = $facturaId;
    }

    public function setCreditoId($creditoId) {
        $this->creditoId = $creditoId;
    }


    //getters

    public function getNombreCliente() {
        return $this->nombreCliente;
    }

    public function getFechaFactura() {
        return $this->fechaFactura;
    }

    public function getMontoCredito() {
        return $this->montoCredito;
    }

    public function getFechaLimite() {
        return $this->fechaLimite;
    }

    public function getFacturaId() {
        return $this->facturaId;
    }

    public function getCreditoId() {
        return $this->creditoId;
    }

}

?>