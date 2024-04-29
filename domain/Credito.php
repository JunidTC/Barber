<?php

class Credito{
    private $creditoId;
    private $creditoFacturaId;
    private $fechaLimite;
    private $cancelacion;
    private $activo;
    private $montoCredito;

    public function __construct($creditoId, $creditoFacturaId, $fechaLimite, $cancelacion, $activo,$montoCredito) {
        $this->creditoId = $creditoId;
        $this->creditoFacturaId = $creditoFacturaId;
        $this->fechaLimite = $fechaLimite;
        $this->cancelacion = $cancelacion;
        $this->activo = $activo;
        $this->montoCredito = $montoCredito;
    }

    public function getCreditoId() {
        return $this->creditoId;
    }

    public function getCreditoFacturaId() {
        return $this->creditoFacturaId;
    }

    public function getFechaLimite() {
        return $this->fechaLimite;
    }

    public function getCancelacion() {
        return $this->cancelacion;
    }

    public function getActivo() {
        return $this->activo;
    }   


    public function setCreditoId($creditoId) {
        $this->creditoId = $creditoId;
    }

    public function setCreditoFacturaId($creditoFacturaId) {
        $this->creditoFacturaId = $creditoFacturaId;
    }

    public function setFechaLimite($fechaLimite) {
        $this->fechaLimite = $fechaLimite;
    }


    public function setCancelacion($cancelacion) {
        $this->cancelacion = $cancelacion;
    } 

    public function setActivo($activo) {
        $this->activo = $activo;
    } 

    public function getMontoCredito() {
        return $this->montoCredito;
    }

    public function setMontoCredito($montoCredito) {
        $this->montoCredito = $montoCredito;
    }

    
}