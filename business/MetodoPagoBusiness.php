<?php

include '../data/MetodoPagoData.php';

class MetodoPagoBusiness
{

    private $metodopagoData;

    public function __construct()
    {
        $this->metodopagoData = new MetodoPagoData();
    }

    public function insertTBMetodoPago($metodopago)
    {
        return $this->metodopagoData->insertTBMetodoPago($metodopago);
    }

    public function updateTBMetodoPago($metodopago)
    {
        return $this->metodopagoData->updateTBMetodoPago($metodopago);
    }

    public function deleteTBMetodoPago($idmetodopago)
    {
        return $this->metodopagoData->deleteTBMetodoPago($idmetodopago);
    }

    public function getAllTBMetodoPagos()
    {
        return $this->metodopagoData->getAllTBMetodoPagos();
    }

    public function getAllTBMetodoPagoDesactivado()
    {
        return $this->metodopagoData->getAllTBMetodoPagoDesactivado();
    }

    public function getTBMetodoPagoById($idmetodopago)
    {
        return $this->metodopagoData->getTBMetodoPagoById($idmetodopago);
    }


    public function getTBMetodoPagoByNombre($nombre)
    {
        return $this->metodopagoData->getTBMetodoPagoByName($nombre);
    }
}
