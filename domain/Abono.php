<?php

class Abono{
    private $abonoId;
    private $fecha;
    private $monto;
    private $creditoId;

    public function __construct($abonoId, $fecha, $monto, $creditoId) {
        $this->abonoId = $abonoId;
        $this->fecha = $fecha;
        $this->monto = $monto;
        $this->creditoId = $creditoId;
    }

    public function getAbonoId() {
        return $this->abonoId;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getMonto() {
        return $this->monto;
    }

    public function getCreditoId() {
        return $this->creditoId;
    }   

    public function setAbonoId($creditoId) {
        $this->creditoId = $creditoId;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }


    public function setMonto($monto) {
        $this->monto = $monto;
    } 

    public function setCreditoId($creditoId) {
        $this->creditoId = $creditoId;
    }
}